<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;


use App\Models\Categorie;

use App\Models\Product;


class AdminController extends Controller
{
    public function index()
    {
        if(Auth::id()){

            $usertype = Auth()->user()->usertype;

            if($usertype == 'admin'){
                return view('admin.index');
            }
            else if($usertype == 'user'){
                $data = Product::all();
                return view('home.index');
            }
            
        }
        else{
            return redirect()->back();
        }

        
    }
    public function categorie_page()
    {
        $data = Categorie::all();
        return view('admin.categorie', compact('data'));
    }
    public function add_category(Request $request)
    {
       $data = new Categorie;
       $data->cat_title = $request->category;
       $data->save();
       return redirect()->back()->with('message', 'Category Added Successfully');
        
    }
    public function cat_delete($id)
    {
        $data = Categorie::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

    public function cat_edit($id)
    {
        $data = Categorie::find($id);
        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data = Categorie::find($id);
        $data->cat_title = $request->cat_name;
        $data->save();
        return redirect('/categorie_page')->with('message', 'Category Updated Successfully');
        
    }
    public function add_product()
    {
        $data = Categorie::all();

        return view('admin.add_product', compact('data'));
    }
    public function store_product(Request $request)
    {
        $data = new Product;
        $data->Merk = $request->product_merk;
        $data->title = $request->product_title;
        $data->Quantity = $request->product_quantity;
        $data->category_id = $request->product_category;
        $data->description = $request->product_description;
        $product_image = $request->product_image;

        if($product_image){
            $product_image_name = time().'.'.$product_image->getClientOriginalExtension();
            $request->product_image->move('producten_images', $product_image_name);
            $data->product_img = $product_image_name;
            
        }

    
        $data->save();
        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show_product()
    {
        $products = Product::all();
        return view('admin.show_product', compact('products'));
    }

    public function product_delete($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function update_product($id)
    {
        $data = Product::find($id);
        $category = Categorie::all();
        
        return view('admin.update_product', compact('data', 'category'));
    }

    public function update_product1(Request $request, $id)
    {
        $data = Product::find($id);
        $data->Merk = $request->product_merk;
        $data->title = $request->product_title;
        $data->Quantity = $request->product_quantity;
        $data->category_id = $request->product_category;
        $data->description = $request->product_description;
        $product_image = $request->product_image;

        if($product_image){
            $product_image_name = time().'.'.$product_image->getClientOriginalExtension();
            $request->product_image->move('producten_images', $product_image_name);
            $data->product_img = $product_image_name;
            
        }

    
        $data->save();
        return redirect('/show_product');
    }
}
