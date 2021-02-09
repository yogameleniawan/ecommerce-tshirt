<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
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
        $data = User::all();
        $jan = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '01')
            ->sum('carts.price');
        $feb = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '02')
            ->sum('carts.price');
        $mar = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '03')
            ->sum('carts.price');
        $apr = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '04')
            ->sum('carts.price');
        $mei = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '05')
            ->sum('carts.price');
        $jun = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '06')
            ->sum('carts.price');
        $jul = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '07')
            ->sum('carts.price');
        $aug = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '08')
            ->sum('carts.price');
        $sep = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '09')
            ->sum('carts.price');
        $oct = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '10')
            ->sum('carts.price');
        $nov = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '11')
            ->sum('carts.price');
        $des = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', '12')
            ->sum('carts.price');
        $now = Carbon::now();
        $monthly = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereMonth('created_at', '=', $now->month)
            ->sum('carts.price');
        $annual = DB::table('carts')
            ->where('status', '=', 'complete')
            ->whereYear('created_at', '=', $now->year)
            ->sum('carts.price');
        $pending = DB::table('carts')
            ->where('status', '=', 'pending')
            ->count();
        $complete = DB::table('carts')
            ->where('status', '=', 'complete')
            ->count();
        $count = DB::table('carts')
            ->where('status', '=', 'complete')
            ->orWhere('status', '=', 'pending')
            ->orWhere('status', '=', 'process')
            ->count();
        $angry = DB::table('scores')
            ->where('rate', '=', 'angry')
            ->count();
        $upset = DB::table('scores')
            ->where('rate', '=', 'upset')
            ->count();
        $neutral = DB::table('scores')
            ->where('rate', '=', 'neutral')
            ->count();
        $happy = DB::table('scores')
            ->where('rate', '=', 'happy')
            ->count();
        $excited = DB::table('scores')
            ->where('rate', '=', 'excited')
            ->count();
        // dd($upset);
        if ($count == 0) {
            $hasil = 0;
        } else if ($count != 0) {
            $hasil = ($complete / $count) * 100;
        }
        $percentage = number_format((float) $hasil, 2);
        return view('admin.main', compact('data', 'angry', 'upset', 'neutral', 'happy', 'excited', 'percentage', 'annual', 'pending', 'monthly', 'jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'des'));
    }

    public function user()
    {
        $data = User::all();
        return view('admin.users', ['data' => $data]);
    }

    public function item()
    {
        $data = User::all();
        return view('admin.users', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->roles = $request->roles;
        $user->save();
        return redirect()->route('users')
            ->with('success', 'User added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $data, $id)
    {
        $data = User::find($id);
        return view('admin.edituser', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
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
        $user->roles = $request->roles;
        $user->save();
        return redirect()->route('users')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user = User::find($id);
        $user->delete();
        $cart = DB::table('carts')
            ->where('id_user', '=', $id)
            ->delete();
        $score = DB::table('scores')
            ->where('id_user', '=', $id)
            ->delete();
        return redirect()->route('users')
            ->with('success', 'User deleted successfully');
    }
}
