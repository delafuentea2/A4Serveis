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
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'descripcion' => 'required',
            //'category' => 'required',
        ]);
        
        $product = new Product([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'descripcion' => $request->input('descripcion'),
            //'category' => $request->input('category'),

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
            'descripcion' => 'required',
            'category' => 'required',
        ]);

        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'descripcion' => $data['descripcion'],
            'category' => $data['category'],
        ]);

        return response()->json([
			'success'=>true,
			'data'=>'Sucessful user created'
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
        $product->delete();
    }
}
