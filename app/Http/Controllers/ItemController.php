<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
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
        $data = Product::all();
        return view('admin.items', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createitem');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->color = $request->color;
        $product->price = $request->price;
        $product->qty = $request->qty;
        if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
            Storage::delete('public/' . $product->image);
        }
        $image_name = $request->file('image')->store('images', 'public');
        $product->image = $image_name;
        $product->save();
        return redirect()->route('items')
            ->with('success', 'Item added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $data, $id)
    {
        $data = Product::find($id);
        return view('admin.edititem', compact('data'));
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
        $data = Product::find($id);
        $data->name = $request->name;
        $data->color = $request->color;
        $data->price = $request->price;
        $data->qty = $request->qty;
        if (empty($request->image)) {
            $data->image = $data->image;
        } else if (!empty($request->image)) {
            if ($data->image && file_exists(storage_path('app/public/' . $data->image))) {
                Storage::delete('public/' . $data->image);
            }
            $image_name = $request->file('image')->store('images', 'public');
            $data->image = $image_name;
        }
        $data->save();
        return redirect()->route('items')
            ->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->route('items')
            ->with('success', 'Item deleted successfully');
    }
}
