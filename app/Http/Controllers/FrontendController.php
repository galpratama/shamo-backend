<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['galleries'])->latest()->get();

        return view('pages.frontend.index', compact('products'));
    }

    public function details(Request $request, $slug)
    {
        $product = Product::with(['galleries'])->where('slug', $slug)->firstOrFail();
        $recommendations = Product::with(['galleries'])->inRandomOrder()->limit(4)->get();

        return view('pages.frontend.details', compact('product','recommendations'));
    }

    public function cart(Request $request)
    {
        return view('pages.frontend.cart');
    }

    public function checkout(Request $request)
    {
        // TODO Checkout page
    }

    public function success(Request $request)
    {
        return view('pages.frontend.success');
    }
}
