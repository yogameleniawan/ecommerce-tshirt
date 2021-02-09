<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = Auth::user()->id;
        $cart = DB::table('carts')
            ->where('status', '=', 'pending')
            ->where('id_user', '=', $userid)
            ->count();
        $data = DB::table('carts')
            ->where('id_user', '=', $userid)
            ->get();
        return view('transaction.cart', compact('cart', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart, $id)
    {
        $userid = Auth::user()->id;
        $cart = DB::table('carts')
            ->where('status', '=', 'pending')
            ->where('id_user', '=', $userid)
            ->count();
        $data = Cart::all();
        return view('transaction.cart', compact('cart', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart, $id)
    {
        $userid = Auth::user()->id;
        $cart = DB::table('carts')
            ->where('status', '=', 'pending')
            ->where('id_user', '=', $userid)
            ->count();
        $data = Cart::find($id);
        return view('transaction.checkout', compact('data', 'cart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Cart::find($id);
        $data->name_item = $request->name_item;
        $data->name_user = $request->name_user;
        $data->address = $request->address;
        $data->price = $request->price;
        if (empty($request->image)) {
            $data->payment = $data->payment;
        } else if (!empty($request->image)) {
            if ($data->image && file_exists(storage_path('app/public/' . $data->payment))) {
                Storage::delete('public/' . $data->payment);
            }
            $image_name = $request->file('image')->store('images', 'public');
            $data->payment = $image_name;
            $data->status = 'process';
        }
        $data->save();
        return redirect()->route('carts')
            ->with('success', 'Cart proccess successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Cart::find($id);
        $data->delete();
        return redirect()->route('carts')
            ->with('success', 'Cart deleted successfully');
    }

    public function receipt($id)
    {
        $userid = Auth::user()->id;
        $receipt = DB::table('receipts')
            ->where('id_cart', '=', $id)
            ->first();
        $cart = DB::table('carts')
            ->where('status', '=', 'pending')
            ->where('id_user', '=', $userid)
            ->count();
        return view('transaction.receipt', compact('cart', 'receipt'));
    }
}
