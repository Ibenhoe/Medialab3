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
        dd($quantity); 
        
    }

}
