<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Borrow;
use App\Models\Categorie;
use App\Models\Favorites;
use App\Models\Cart;

class HomeController extends Controller
{
    public function index()
    {
        $data = Product::paginate(10);
        $data2 = Categorie::all();

        return view('home.index', compact('data', 'data2'));
       
        
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
        $data = Product::paginate(10);
        $data2 = Categorie::all();
        return view('home.mainpage', compact('data', 'data2'));
    }

    public function search(Request $request)
{
    // Valideer de invoer
    $validatedData = $request->validate([
        'search' => 'nullable|string',
        'Category' => 'nullable|string', // Pas de validatieregels aan op basis van wat je verwacht
    ]);

    // Haal de gevalideerde invoer op
    $search = $validatedData['search'] ?? '';
    $category = $validatedData['Category'];

    // Haal alle categorieën op
    $data2 = Categorie::all();

    // Bouw de zoekquery op met behulp van Eloquent-methoden
    $query = Product::query();
    
    if ($search) {
        $query->where(function($query) use ($search) {
            $query->where('title', 'like', '%'.$search.'%')
                  ->orWhere('Merk', 'like', '%'.$search.'%')
                  ->orWhere(function($query) use ($search) {
                      $query->whereRaw('CONCAT(Merk, " ", title) like ?', ['%'.$search.'%']);
                  });
        });
    }

    // Optioneel: Filter op categorie als een specifieke categorie is geselecteerd
    if ($category && $category != 'All Categories') {
        $query->where('category_id', $category);
    }

    // Haal de resultaten op en geef deze door naar de view
    $data = $query->paginate(10);
    $data->appends(['search' => $search, 'Category' => $category]);

    return view('home.mainpage', compact('data', 'data2'));
}
    public function details_product($id)
    {
        $data = Product::find($id);
        return view('home.details_product', compact('data'));
    }

    public function add_favorites($id)
    {
        $user_id = Auth::user()->id;
        $favorites = new Favorites();
        $product_id = $id;
        
        $favorites->product_id = $product_id;
        $favorites->user_id = $user_id;
        $favorites->save();
        return redirect()->back()->with('message', 'Product added to favorites');
    }
    public function show_favorites()
    {
        $user_id = Auth::user()->id;
        $data = Favorites::where('user_id', $user_id)->with('product')->get();
        return view('home.show_favorites', compact('data'));
    }

    public function add_cart($id)
    {
        $user_id = Auth::user()->id;
        $product_id = $id;
        $data = new Cart();

        $data->product_id = $product_id;
        $data->user_id = $user_id;
        $data->save();

        return redirect()->back();
    }

}
