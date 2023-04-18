<?php

namespace App\Http\Controllers\Api;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Resources\ProviderResource;
use App\Http\Requests\ProviderRequest;
use App\Http\Resources\ProviderResource;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider = Provider::all();
        $r= ProviderResource::collection($provider);

        return response()->json($r);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProviderRequest $request)
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
        ]);
        
        $provider = new Provider([
            'name' => $request->input('name'),
            'company_name' => $request->input('company_name'),
            'phone' => $request->input('phone'),

        ]);
        $provider->save();

        return response()->json([
			'success'=>true,
			'data'=>'Sucessful user created'
		],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = Provider::find($id);

        if (!$provider) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return $provider;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, $id)
    {
        $provider = Provider::find($id);
        if (!$provider) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $data= $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
        ]);
        
        $provider->update()([
            'name' => $data['name'],
            'company_name' => $data['company_name'],
            'phone' => $data['phone']
        ]);

        return response()->json([
			'success'=>true,
			'data'=>'Sucessful user created'
		],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
    }
}
