<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Gate::allows('admin')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
            if (Gate::allows('staff')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cart::all();
        return view('admin.transaction', compact('data'));
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
    public function store(Cart $cart, Request $request)
    {
        $cart = new Cart();
        $cart->id_user = $request->iduser;
        $cart->name_user = $request->buyer;
        $cart->name_item = $request->nameitem;
        $cart->address = $request->address;
        $cart->phone = $request->phone;
        $cart->price = $request->price * $request->qty;
        $cart->size = $request->size;
        $cart->qty = $request->qty;
        $cart->save();
        return redirect()->route('transaction')
            ->with('success', 'Item added in Cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $data, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart, $id)
    {
        $data = Cart::find($id);
        $receipt = DB::table('receipts')
            ->where('id_cart', '=', $id)
            ->first();
        // dd($receipt);
        return view('admin.edittransaction', compact('data', 'receipt'));
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
        $data->id_user = $request->iduser;
        $data->name_item = $request->item;
        $data->name_user = $request->user;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->price = $request->price;
        if (empty($request->status)) {
            $data->status = $data->status;
        } else {
            $data->status = $request->status;
        }
        $data->save();
        if (!empty($request->receipt_image && $request->receipt)) {
            $receipt = new Receipt();
            $receipt->id_cart = $id;
            if (empty($request->receipt_image)) {
                $receipt->receipt_image = $receipt->receipt_image;
            } else if (!empty($request->receipt_image)) {
                if ($receipt->receipt_image && file_exists(storage_path('app/public/' . $receipt->receipt_image))) {
                    Storage::delete('public/' . $receipt->receipt_image);
                }
                $image_name = $request->file('receipt_image')->store('images', 'public');
                $receipt->receipt_image = $image_name;
            }
            $receipt->no_receipt = $request->receipt;
            $receipt->save();
        }
        return redirect()->route('admin.transaction')
            ->with('success', 'Transaction updated successfully');
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
        return redirect()->route('admin.transaction')
            ->with('success', 'Transaction deleted successfully');
    }
}
