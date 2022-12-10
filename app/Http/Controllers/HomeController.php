<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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
        $coffee = Product::select('products.*', 'c.name as category_name')
            ->join('categories as c', 'c.id', 'products.category_id')
            ->where('products.status', 1)
            ->where('c.status', 1)
            ->where('raw', 0)
            ->paginate(5);

        $seeds = Product::select('products.*', 'c.name as category_name')
            ->join('categories as c', 'c.id', 'products.category_id')
            ->where('products.status', 1)
            ->where('c.status', 1)
            ->where('raw', 1)
            ->paginate(5);
        return view('user.landing', compact(['seeds', 'coffee']));
    }

    public function coffee(Request $request)
    {
        $search = false;
        if ($request->search != null) {
            $coffee = Product::select('products.*', 'c.name as category_name')
                ->join('categories as c', 'c.id', 'products.category_id')
                ->where('products.status', 1)
                ->where('c.status', 1)
                ->where('products.name', 'LIKE', '%' . $request->search . '%')
                ->get();
            $search = true;
            return view('user.coffee', compact(['coffee', 'search']));
        } else {
            $coffee = Product::select('products.*', 'c.name as category_name')
                ->join('categories as c', 'c.id', 'products.category_id')
                ->where('products.status', 1)
                ->where('c.status', 1)
                ->get();
            return view('user.coffee', compact(['coffee', 'search']));
        }
    }

    public function cart()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => ['key' => env("RAJA_ONGKIR_KEY")]

        ]);
        $city = json_decode($response->getBody()->getContents())->rajaongkir->results;
        return view('user.cart', compact('city'));
    }

    public function order(Request $request)
    {
        if (isset($request->products) == null) {
            return redirect()->back()->with('error', 'Oops. Kamu belum membeli apapun!');
        }

        $set        = Setting::first();
        // $phone      = $set->whatsapp;
        // $phone_code = substr((int)$phone, 0, 2);
        // if ((int)$phone_code == 62) {
        //     $phone_number = $phone;
        // } else {
        //     $phone_number = '62' . substr($phone, 1);
        // }
        // $id_product = $request->id_product;
        // $quantity   = $request->quantity;
        // $total_qty  = 0;
        // $total      = 0;

        // // $api_wa     = 'https://wa.me/send?phone=';
        // $api_wa     = 'https://api.whatsapp.com/send/?phone=';
        // $text       = [];
        // $text[]     = 'Mau Pesan dong kak!';
        // $text[]     = '';
        // $text[]     = 'Detail Pemesan :';
        // $text[]     = '- Nama lengkap      :   *' . $request->name . '*';
        // $text[]     = '- Telepon                  :   *' . $request->phone . '*';
        // $text[]     = '- Alamat Lengkap   : %0A  *' . $request->address . '*';
        // $text[]     = '- Catatan                   : %0A  ' . $request->noted;
        // $text[]     = '';
        // $text[]     = 'Detail Barang :';
        // foreach ($id_product as $key => $id_product) {
        //     $product = Product::find($id_product);

        //     $total_qty += $quantity[$key];
        //     $total += $product->price * $quantity[$key];

        //     $no = $key + 1;
        //     $text[] = $no . '. ' . $product->name;
        //     $text[] = '     ' . $quantity[$key] . ' @ Rp. ' . numberFormat($product->price);
        //     $text[] = '     ' . '*Total Rp. ' . numberFormat($product->price * $quantity[$key]) . '*';
        //     $text[] = '';
        // }
        // $text[] = '----------------------------------------';
        // $text[] = 'Detail pembelian';
        // $text[] = 'Total Barang          : *' . numberFormat(count($quantity)) . '* Jenis';
        // $text[] = 'Total Unit               : *' . numberFormat($total_qty) . '*';
        // $text[] = 'Total Keseluruhan : *Rp. ' . numberFormat($total) . '*';
        // $text[] = '----------------------------------------';
        // $text[] = 'Kunjungi Toko : coffee-center.com';

        dd($request->all());

        // return redirect()->away($api_wa . $phone_number . '&text=' . implode('%0A', $text));
    }

    public function getCourier(Request $request)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
            'headers' => ['key' => env("RAJA_ONGKIR_KEY")],
            'form_params' => [
                'origin' => $request->origin,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => $request->courier,
            ],
        ]);
        return response()->json(['data' => json_decode($response->getBody()->getContents())->rajaongkir]);
    }
}
