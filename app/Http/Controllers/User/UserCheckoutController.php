<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Produk;
use App\Models\User;
use App\Models\Order;
use App\Models\Pembayaran;

$numberorder = Str::random(5);

use Session;

class UserCheckoutController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->get();
        $rt = Order::with(['produk'])->where('status', 'Mau Beli')->where('id_user', Auth::user()->id)->get();

        return view('User.Page.Checkout.Checkout', compact('rt', 'user'));
    }

    public function checkout($id, Request $request)
    {
         
        $request->validate([
            'jumlah'        => 'required',
        ]);

        $produk = Produk::find($id)->id;
        $user_id = Auth::user()->id;

        $pro = Produk::find($id);
        
        if($request->jumlah > $pro->stok_produk)
        {
            return redirect(route('detail.index', $pro->id))->with(['success' => 'Stok Tidak Tersedia']);
        }
        else{
                $order = new Order;

                $order->id_produk = $produk;
                $order->id_user = $user_id;
                $order->jumlah = $request->jumlah;
                
                $order->save(); 

                $pro->stok_produk = $pro->stok_produk - $request->jumlah;
                $pro->save();
            
        }

        return redirect(route('checkout.index'));

    }

    public function create(Request $request)
    {
            $cart =  Order::count();        
            $user_id = Auth::user()->id;
            $cr = Order::with(['produk'])->where('status', 'Mau Beli')->where('id_user', Auth::user()->id)->get();

            $cr->status = 'Sudah Beli';
            $cr->save();

            $numberorder = Str::random(5);

            // $tot = Cart::where('id_user', Auth::user()->id)
            //     ->select('produks.harga', 'produks.id as id_produk', 'produks.harga', 'carts.jumlah', 'carts.id as id')
            //     ->join('produks', 'produks.id', '=', 'carts.id_produk')
            //     ->sum(Cart::raw('produks.harga * carts.jumlah'));

            $order = new Pembayaran;
            $order->id_user = $user_id;
            $order->no_order = $numberorder;
            $order->total = $request->total;
            $order->id_order =  $request->idorder;
            $order->pembayaran =  $request->pembayaran;
            $order->save();

            // foreach($cr as $c)
            // {
            //     $ordershop = new Order;
            //     $ordershop->id_produk = $c->id_produk;
            //     $ordershop->id_nelayan = $c->id_nelayan;
            //     $ordershop->jumlah =  $c->jumlah;
            //     $ordershop->id_user = $user_id;
            //     $ordershop->no_order = $numberorder;
            //     $ordershop->id_pembayaran = $order->id;
            //     $ordershop->save();
            // }
            return redirect(route('landing.index'));

    }
}
