<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->paginate(10);
        return view('frontend.page.home', [
            'title' => 'Halaman Home',
            'products' => $products,
        ]);
    }

    public function detailProduct($id)
    {
        $data = Product::findorFail($id);
        return view('frontend.page.detailProduct', [
            'title' => 'Halaman Detail Product',
            'data' => $data,
        ]);
    }
}
