<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (empty(Auth::user()->id)) {
            return view('index');
        } else if (!empty(Auth::user()->id)) {
            $id = Auth::user()->id;
            $cart = DB::table('carts')
                ->where('status', '=', 'pending')
                ->where('id_user', '=', $id)
                ->count();
        }
        return view('index', compact('cart'));
    }

    public function transaction()
    {
        $data = Product::all();
        if (empty(Auth::user())) {
            return view('transaction.index', compact('data', 'cart'));
        } else if (!empty(Auth::user())) {
            $id = Auth::user()->id;
            $cart = DB::table('carts')
                ->where('status', '=', 'pending')
                ->where('id_user', '=', $id)
                ->count();
            return view('transaction.index', compact('data', 'cart'));
        }
    }

    public function cart()
    {

        return view('cart', compact('cart'));
    }

    public function show(Product $data, $id)
    {
        if (empty(Auth::user())) {
            return redirect()->route('login');
        }
        $userid = Auth::user()->id;
        $cart = DB::table('carts')
            ->where('status', '=', 'pending')
            ->where('id_user', '=', $userid)
            ->count();
        $data = Product::find($id);
        // dd($data);
        return view('transaction.order', compact('data', 'cart'));
    }

    public function store(Cart $cart, Request $request)
    {
        $cart = new Cart();
        $cart->id_user = $request->iduser;
        $cart->id_item = $request->iditem;
        $cart->name_user = $request->buyer;
        $cart->name_item = $request->nameitem;
        $cart->address = $request->address;
        $cart->phone = $request->phone;
        $cart->price = $request->price * $request->qty;
        $product = Product::find($request->iditem);
        $product->name = $product->name;
        $product->image = $product->image;
        $product->color = $product->color;
        $product->price = $product->price;
        if ($product->qty >= $request->qty) {
            $product->qty = $product->qty - $request->qty;
        } else {
            $product->qty = $product->qty;
            return Redirect::back()->withErrors(['Qty not available']);
        }
        $product->save();
        if (empty($request->size)) {
            $cart->size = 'L';
        } else if (!empty($request->size)) {
            $cart->size = $request->size;
        }
        $cart->qty = $request->qty;
        $cart->save();
        return redirect()->route('carts')
            ->with('success', 'Item added in Cart');
    }
}
