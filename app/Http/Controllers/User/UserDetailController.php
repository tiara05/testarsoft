<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Produk;
use App\Models\Kstegori;
// use App\Models\Favorit;
// use App\Models\Review;

use Session;

class UserDetailController extends Controller
{
    public function index($id)
    {
        $kategori = Kstegori::all();

        $produk = Produk::find($id);

        // $pr = Favorit::whereNotIn('id_produk', $produk)->get();

        // if(session()->has('user')){
        //     $pro = Favorit::where('id_produk', $produk->id)->where('id_user', Auth::user()->id)->get();
        // }
        // else{
        //     $pro = Favorit::where('id_produk', $produk->id)->get();
        // }

        // $review = Review::with(['produk'])
        // ->with(['user'])
        // ->where('id_produk', '=', $id)
        // ->get();

        // dd($pro);
        return view('User.Page.Detail.Detail', compact('produk', 'kategori'));
    }
}
