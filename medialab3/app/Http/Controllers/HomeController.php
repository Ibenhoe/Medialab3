<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Borrow;
use App\Models\Categorie;




class HomeController extends Controller
{
    public function index()
    {
        $data = Product::all();

        return view('home.index', compact('data'));
       
        
    }
    public function borrow_product($id)
    {
        $data = Product::find($id);
        $quantity = $data->Quantity;
        $product_id = $id;
        
            if($quantity >= 1){
                if(Auth::id()){
                    $user_id = Auth::user()->id; 
                    $borrow = new Borrow();
                    $borrow->product_id = $product_id;
                    $borrow->user_id = $user_id;
                    $borrow->status = 'pending';
                    $borrow->save();
                return redirect()->back()->with('message', 'A request has been sent to the admin for approval.');


                    
                }else{
                    return redirect('/login');
                }

            }else{
                return redirect()->back()->with('message', 'Product is out of stock');
            }
        
    }
    public function mainpage()
    {   
        $data = Product::all();
        $data2 = Categorie::all();
        return view('home.mainpage', compact('data', 'data2'));
    }

    public function search(Request $request)

    {
        
        $search = $request->input('search');
        $category = $request->input('Category');
        $data2 = Categorie::all();
    
        $data = Product::selectRaw('*, CONCAT(Merk, " ", title) AS combined_name')
                        ->where(function($query) use ($search) {
                            $query->where('title', 'like', '%'.$search.'%')
                                  ->orWhere('Merk', 'like', '%'.$search.'%')
                                  ->orWhereRaw('CONCAT(Merk, " ", title) like ?', ['%'.$search.'%']);
                        });
    
        // Optioneel: Filter op categorie als een specifieke categorie is geselecteerd
        if ($category && $category != 'All Categories') {
            $data->where('category_id', $category);
        }
    
        $data = $data->get();
    
        return view('home.mainpage', compact('data', 'data2'));
    
    }

}
