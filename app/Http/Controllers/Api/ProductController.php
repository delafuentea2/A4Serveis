<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        $r= ProductResource::collection($product);

        return response()->json($r);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data=$request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);
        //$data= $request->validated();
        $product = new Product([
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'category' => $data['category'],

        ]);
        $product->save();

        return response()->json([
			'success'=>true,
			'data'=>'Sucessful user created'
		],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $data= $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);
        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'category' => $data['category'],
        ]);


        return response()->json([
			'success'=>true,
			'data'=>'Sucessful product updated',
		],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();

        return response()->json([
            'success' => true,
            'data' => 'Successful product deleted'
        ], 200);
    }

    public function checkUpdate(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        var_dump("_________PRODUCTO ORIGINAL__________");
        var_dump($product);
        $data= $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);
        var_dump("_________PRODUCTO PARA CAMBIAR__________");
        var_dump($data);
        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'category' => $data['category'],
        ]);
        var_dump("_________PRODUCT POST-UPDATE__________");
        var_dump($product);
        return response()->json([
			'success'=>true,
			'data'=>'Sucessful product updated',
		],201);

    }

    public function checkObject($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        dd($product);
    }
}
