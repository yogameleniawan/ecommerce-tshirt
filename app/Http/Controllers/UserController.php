<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Score;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.editprofile');
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
        $score = new Score();
        $score->id_user = $request->iduser;
        $score->id_cart = $request->idcart;
        $score->name_user = $request->nameuser;
        $score->rate = $request->rate;
        $score->save();
        return redirect()->route('carts')
            ->with('success', 'Rate successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $userid = Auth::user()->id;
        $cart = DB::table('carts')
            ->where('status', '=', 'pending')
            ->where('id_user', '=', $userid)
            ->count();
        return view('user.editprofile', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart, $id)
    {
        $idcart = $id;
        $userid = Auth::user()->id;
        $cart = DB::table('carts')
            ->where('id', '=', 'pending')
            ->where('id_user', '=', $userid)
            ->count();
        $done = DB::table('scores')
            ->where('id_cart', '=', $id)
            ->where('id_user', '=', $userid)
            ->get();
        $count = DB::table('scores')
            ->where('id_cart', '=', $id)
            ->where('id_user', '=', $userid)
            ->count();
        $data = Cart::find($id);
        // dd($done);
        return view('transaction.rate', compact('data', 'count', 'cart', 'done'));
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (empty($request->password)) {
            $user->password = $user->password;
        } else if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if (empty($request->image)) {
            $user->image_profile = $user->image_profile;
        } else if (!empty($request->image)) {
            if ($user->image_profile && file_exists(storage_path('app/public/' . $user->image_profile))) {
                Storage::delete('public/' . $user->image_profile);
            }
            $image_name = $request->file('image')->store('images', 'public');
            $user->image_profile = $image_name;
        }
        $user->save();
        if (Auth::user()->roles == 'admin' || Auth::user()->roles == 'staff') {
            return redirect()->route('name.profile')
                ->with('success', 'User updated successfully');
        } else if (Auth::user()->roles == 'pelanggan') {
            return redirect()->route('user.profile')
                ->with('success', 'User updated successfully');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
