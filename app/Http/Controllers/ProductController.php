<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($platformId)
    {
        $products = Product::join('users', 'products.seller_id', '=', 'users.id')
                            ->join('plataforms', 'users.platform_id', '=', 'plataforms.id')
                            ->where('plataforms.id', $platformId)->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        Product::create($inputs);

        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $inputs = $request->all();

        $product->update($inputs);

        return redirect()->route('product.index');
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
