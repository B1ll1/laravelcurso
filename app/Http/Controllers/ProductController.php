<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Product;
use App\Models\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($platformId)
    {
        $products = Product::where('platform_id', $platformId)->get();

        return view('products.index', compact('products', 'platformId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($platformId)
    {
        return view('products.create', compact('platformId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $platformId)
    {
        $available = 1;

        $inputs = $request->all();
        $inputs['seller_id']   = Auth::user()->id;
        $inputs['platform_id'] = Auth::user()->user_role_id == 1 ? $platformId : Auth::user()->platform->id;
        $inputs['status_id'] = $available;

        Product::create($inputs);

        return redirect()->route('platform.product.index', [$platformId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($platformId, $productId)
    {
        $product = Product::findOrFail($productId);
        $productStatus = ProductStatus::all();

        return view('products.edit', compact('product', 'productStatus', 'platformId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $platformId, $productId)
    {
        $product = Product::findOrFail($productId);
        $inputs = $request->all();

        $product->update($inputs);

        return redirect()->route('platform.product.index', [$platformId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $productId)
    {
        if(!$request->ajax())
            abort(403);

        $product = Product::destroy($productId);

        if($product) {
            return response()->json(['status' => 'success', 'productId' => $productId]);
        }
        return response()->json(['status' => 'fail', 'productId' => $productId]);
    }
}
