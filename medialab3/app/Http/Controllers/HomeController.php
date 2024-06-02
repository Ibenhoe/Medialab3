<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Categorie;
use App\Models\Favorites;
use App\Models\Cart;
use App\Models\Reservation;
use App\Models\Product;
use App\Models\Item;
use App\Mail\HelloMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

<<<<<<< Updated upstream
use function PHPUnit\Framework\isNull;
=======
>>>>>>> Stashed changes

class HomeController extends Controller
{
    public function index()
    {
        $data = Product::whereHas('items', function ($query) {
            $query->where('availability', '>', 0);
        })->withCount(['items as remaining' => function ($query) {
            $query->where('availability', '>', 0);
        }])->paginate(10);

        $data2 = Categorie::all();

        return view('home.mainpage', compact('data', 'data2'));
    }
    public function mainpage()
    {
        $data = Product::whereHas('items', function ($query) {
            $query->where('availability', '>', 0);
        })->withCount(['items as remaining' => function ($query) {
            $query->where('availability', '>', 0);
        }])->paginate(10);
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
        $availability = $validatedData['Beschikbaarheid'] ?? null;

        // Haal alle categorieën op
        $data2 = Categorie::all();

        // Bouw de zoekquery op met behulp van Eloquent-methoden
        $query = Product::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('Merk', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere(function ($query) use ($search) {
                        $query->whereRaw('CONCAT(Merk, " ", title) like ?', ['%' . $search . '%']);
                    });
            });
        }

        // Optioneel: Filter op categorie als een specifieke categorie is geselecteerd
        if ($category && $category != 'Alle categorieën') {
            $query->where('category_id', $category);
        }
        if ($availability === 'Niet_beschikbaar') {
            $query->whereDoesntHave('items', function ($query) {
                $query->where('availability', '>', 0);
            }); // Toon producten waar de hoeveelheid gelijk is aan 0
        } elseif ($availability === 'Beschikbaar') {
            $query->whereHas('items', function ($query) {
                $query->where('availability', '>', 0);
            }); // Toon producten waar de hoeveelheid groter is dan 0
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
            $query->where(function ($query) use ($search) {
                $query->where('Merk', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere(function ($query) use ($search) {
                        $query->whereRaw('CONCAT(Merk, " ", title) like ?', ['%' . $search . '%']);
                    });
            });
        }

        // Optioneel: Filter op categorie als een specifieke categorie is geselecteerd

        // Haal de resultaten op en geef deze door naar de view
        $query->whereHas('items', function ($query) {
            $query->where('availability', '>', 0);
        });
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
        return redirect()->back()->with('message', 'Product toegevoegd aan favorieten.');
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

        return redirect()->back()->with('message', 'Product toegevoegd aan winkelwagen.');
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

    public function reservation(Request $request)
    {
        $today = Carbon::today();
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'start_date' => 'required|date|after_or_equal:'.$today,
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
            'Defect' => 'nullable|string|max:255',
        ]);

        $product = Product::find($request->product_id);

        // Check if the product exists and has available items
        if ($product && $product->remaining >= 1) {
            // Check if the user is logged in
            if (Auth::check()) {
                // Retrieve the ID of the logged-in user
                $user_id = Auth::id();

<<<<<<< Updated upstream
                // Find an available item for the product
                $item = Item::where('product_id', $request->product_id)
=======
            if ($request->start_date < Carbon::now()->toDateString()) {
                return redirect()->back()->with('message', 'The start date must be today or later.');
            }
            
            // Find an available item for the product
            $item = Item::where('product_id', $request->product_id)
>>>>>>> Stashed changes
                    ->where('availability', 1)
                    ->first();

                // Create a new reservation
                if ($item) {
                    $reservation = new Reservation();
                    $reservation->product_id = $request->product_id;
                    $reservation->item_id = $item->item_id; // Associate the item
                    $reservation->user_id = $user_id;
                    $reservation->status = 'pending';
                    $reservation->start_date = $request->start_date;
                    $reservation->end_date = $request->end_date;
                    $reservation->reason = $request->reason;
                    $reservation->Defect = $request->Defect;
                    $item->availability = 0;
                    // Get user details
                    $reservation->save();
                    $item->save();
                    $user = Auth::user();
                    $item->item = $item->serial_number;

                    Mail::to($user->email)->send(new HelloMail($user, $item, $product, $reservation));
                    return redirect()->back()->with('message', 'Your reservation request has been sent.');
                } else {
                    // Handle the case where no available item is found
                    return redirect()->back()->with('message', 'No available item found for the selected dates.');
                }
            } else {
                // User is not logged in
                return redirect('/login');
            }
        } else {
            // Product is out of stock
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
        $today = Carbon::today();
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|array',
            'start_date.*' => 'required|date|after_or_equal:'.$today,
            'end_date' => 'required|array',
            'end_date.*' => 'required|date|after_or_equal:start_date.*',
            'reason' => 'required|string|max:255',
        ]);
    
        // Aangepaste validatie: controleer of elke einddatum na de bijbehorende startdatum is
        $validator->after(function ($validator) use ($request) {
            $start_dates = $request->start_date;
            $end_dates = $request->end_date;
    
            foreach ($start_dates as $product_id => $start_date) {
                if (isset($end_dates[$product_id]) && Carbon::parse($end_dates[$product_id])->lt(Carbon::parse($start_date))) {
                    $validator->errors()->add("end_date.$product_id", "The end date must be after or equal to the start date.");
                }
            }
        });
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Loop door de startdatums heen en maak reserveringen aan
        foreach ($request->start_date as $product_id => $startDate) {

            $product = Product::find($product_id);

            // Check if the product exists and has available items
            if ($product && $product->remaining >= 1) {
                // Find an available item for the product
                $item = Item::where('product_id', $product_id)
                    ->where('availability', 1)
                    ->first();

                // Create a new reservation
                if ($item) {
                    $reservation = new Reservation();
                    $reservation->product_id = $product_id;
                    $reservation->item_id = $item->item_id; // Associate the item
                    $reservation->user_id = $user_id;
                    $reservation->status = 'pending';
                    $reservation->start_date = $startDate;
                    $reservation->end_date = $request->end_date[$product_id];
                    $reservation->reason = $request->reason;
                    $reservation->defect =  null;
                    $reservation->save();

                    // Update item availability
                    $item->availability = 0;
                    $item->save();
                }
            }
            Cart::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        }


        return redirect()->back()->with('message', 'Reserveringen succesvol aangemaakt en items verwijderd uit de winkelwagen.');
    }
    public function blacklistview()
    {

        return view('home.blacklistpage');
    }
    public function schadeMelden(Request $request, $id)
    {
        $request->validate([
            'schadeOmschrijving' => 'required|string|max:255',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->defect = $request->schadeOmschrijving;
        $reservation->save();

        return redirect()->back()->with('message', 'Schade is gemeld.');
    }
    public function extended($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Controleer of de reservering al verlengd is
        if ($reservation->extended) {
            return redirect()->back()->with('message', 'Reservering is al verlengd.');
        }

        // Verleng de reservering met 7 dagen
        $reservation->end_date = Carbon::parse($reservation->end_date)->addDays(7);
        $reservation->extended = 1; // Zet de extended flag op true
        $reservation->save();

        return redirect()->back()->with('message', 'Reservering succesvol verlengd.');
    }
}
