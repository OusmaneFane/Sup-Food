<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::all();
    $products = Product::with('category')->get();
    $cartCount = count(session('cart', []));
    $PasseUser = $request->session()->get('PasseUser');
    $user = auth()->user();
    $userOrdersCount = $user ? $user->commands()->count() : 0; 
        $actel_user = Http::withToken($PasseUser)->get(
            'https://api-staging.supmanagement.ml/users/current'
        );
    $studentInfos = $actel_user->json();
  // dd($studentInfos);
    return view('students.index', compact('categories', 'products', 'cartCount', 'studentInfos', 'userOrdersCount' ));

}
}
