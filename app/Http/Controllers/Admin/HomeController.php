<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index()
{
    $categories = Category::all();
    $products = Product::with('category')->get();
    $cartCount = count(session('cart', []));
    return view('students.index', compact('categories', 'products', 'cartCount'));

}
}
