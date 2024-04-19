<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Borrow;




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
        
            if($quantity >= 1){
                if(Auth::id()){
                    
                }else{
                    return redirect('/login');
                }

            }else{
                return redirect()->back()->with('message', 'Product is out of stock');
            }
        
    }

}
