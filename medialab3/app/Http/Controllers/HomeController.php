<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


use App\Models\Borrow;
use App\Models\Categorie;
use App\Models\Favorites;
use App\Models\Cart;
use App\Models\Reservation;
use App\Models\Product;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        $data = Product::where('Quantity', '>', 0)->paginate(10);
        $data2 = Categorie::all();

        return view('home.mainpage', compact('data', 'data2'));
       
        
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
        'Category' => 'nullable|string',
        'Beschikbaarheid' => 'nullable|string', // Pas de validatieregels aan op basis van wat je verwacht
    ]);

    // Haal de gevalideerde invoer op
    $search = $validatedData['search'] ?? '';
    $category = $validatedData['Category'];
    $availability = $validatedData['Beschikbaarheid'];

    // Haal alle categorieën op
    $data2 = Categorie::all();

    // Bouw de zoekquery op met behulp van Eloquent-methoden
    $query = Product::query();
    
    if ($search) {
        $query->where(function($query) use ($search) {
            $query->where('Merk', 'like', '%'.$search.'%')
                  ->orWhere('title', 'like', '%'.$search.'%')
                  ->orWhere(function($query) use ($search) {
                      $query->whereRaw('CONCAT(Merk, " ", title) like ?', ['%'.$search.'%']);
                  });
        });
    }

    // Optioneel: Filter op categorie als een specifieke categorie is geselecteerd
    if ($category && $category != 'Alle categorieën') {
        $query->where('category_id', $category);
    }
    if ($availability === 'Niet_beschikbaar') {
        $query->where('Quantity', 0); // Toon producten waar de hoeveelheid gelijk is aan 0
    } elseif ($availability === 'Beschikbaar') {
        $query->where('Quantity', '>', 0); // Toon producten waar de hoeveelheid groter is dan 0
    }

    // Haal de resultaten op en geef deze door naar de view
    
    $data = $query->paginate(10);
    $data->appends(['search' => $search, 'Category' => $category]);
    

    return view('home.mainpage', compact('data', 'data2'));
}
    public function search2(Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'nullable|string',
            // Pas de validatieregels aan op basis van wat je verwacht
        ]);
    
        // Haal de gevalideerde invoer op
        $search = $validatedData['search'] ?? '';
        
    
        // Haal alle categorieën op
        
    
        // Bouw de zoekquery op met behulp van Eloquent-methoden
        $query = Product::query();
        
        if ($search) {
            $query->where(function($query) use ($search) {
                $query->where('Merk', 'like', '%'.$search.'%')
                      ->orWhere('title', 'like', '%'.$search.'%')
                      ->orWhere(function($query) use ($search) {
                          $query->whereRaw('CONCAT(Merk, " ", title) like ?', ['%'.$search.'%']);
                      });
            });
        }
    
        // Optioneel: Filter op categorie als een specifieke categorie is geselecteerd
        
        // Haal de resultaten op en geef deze door naar de view
        $query->where('Quantity', '>', 0);
        $data = $query->paginate(10);
        $data->appends(['search' => $search]);
        $data2 = Categorie::all();
        return view('home.mainpage', compact('data', 'data2'));
    }


    public function details_product($id)
    {
        $data = Product::find($id);
        $quantity = $data->Quantity; // Beschikbaarheid wordt bijgehouden met de 'Quantity'-kolom

        // Initialiseer de variabele om de onbeschikbare datums op te slaan
        $unavailable_dates = [];

        if ($quantity == 0) {
            // Haal reserveringen op voor het product
            $reservations = Reservation::where('product_id', $id)->get();

            // Sorteer reserveringen op einddatum en haal de eerste reservering op
            $closest_reservation = $reservations->sortBy('end_date')->first();
            if ($closest_reservation) {
                $closest_end_date = Carbon::parse($closest_reservation->end_date)->toDateString();
                // Voeg de einddatum van de eerste reservering toe aan de lijst met onbeschikbare datums
                $unavailable_dates[] = $closest_end_date;
            }
        }

return view('home.details_product', compact('data', 'quantity', 'unavailable_dates'));
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
    public function favo_delete($id)
    {
        $data = Favorites::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function show_cart()
    {
        $user_id = Auth::user()->id;
        $data = Cart::where('user_id', $user_id)->with('product')->get();
        return view('home.show_cart', compact('data'));
    }
    public function show_reservation()
    {
        $data = Reservation::where('user_id', Auth::user()->id)->get();
        return view('home.show_reservation', compact('data'));
    }

    public function reservation(Request $request){
        $request->validate([
            'product_id' => 'required|integer',
            'user_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
            'Defect' => 'nullable|string|max:255',
        ]);
    
        $product = Product::find($request->product_id);

    // Controleer of het product bestaat en er voorraad beschikbaar is
    if ($product && $product->Quantity >= 1) {
        // Controleer of de gebruiker is ingelogd
        if (Auth::check()) {
            // Haal de ID van de ingelogde gebruiker op
            $user_id = Auth::id(); 

            // Maak een nieuwe reservering aan
            $reservation = new Reservation();
            $reservation->product_id = $request->product_id;
            $reservation->user_id = $user_id;
            $reservation->status = 'pending'; 
            $reservation->start_date = $request->start_date; 
            $reservation->end_date = $request->end_date; 
            $reservation->reason = $request->reason;
            $reservation->Defect = $request->Defect;
            $reservation->save();

            
            return redirect()->back()->with('message', 'Your reservation request has been sent.');
        } else {
            
            return redirect('/login');
        }
    } else {
        
        return redirect()->back()->with('message', 'This product is out of stock.');
    }
    }
    public function delete_cart($id)
    {
        $data = Cart::find($id);
        $data->delete();
        return redirect()->back();
    }
    // In je controller



    public function confirmReservation(Request $request)
    {
        $user_id = Auth::id();

        // Validatie van de input
        $request->validate([
            'start_date' => 'required|array',
            'start_date.*' => 'required|date',
            'end_date' => 'required|array',
            'end_date.*' => 'required|date|after_or_equal:start_date.*',
            'reason' => 'required|string',
        ]);

        // Loop door de startdatums heen en maak reserveringen aan
        foreach ($request->start_date as $product_id => $startDate) {
            $reservation = new Reservation();
            $reservation->product_id = $product_id; // Gebruik de juiste product_id
            $reservation->user_id = $user_id;
            $reservation->status = 'pending';
            $reservation->start_date = $startDate;
            $reservation->end_date = $request->end_date[$product_id];
            $reservation->reason = $request->reason;
            $reservation->defect = null; // Defect is niet meegegeven, dus blijft null
            $reservation->save();

            // Verwijder het item uit de winkelwagen
            Cart::where('product_id', $product_id)->where('user_id', $user_id)->delete();
        }

        return redirect()->back()->with('message', 'Reserveringen succesvol aangemaakt en items verwijderd uit de winkelwagen.');
    }
}

