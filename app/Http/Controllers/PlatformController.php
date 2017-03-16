<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\PlatformRequest;
use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $platforms = Platform::all();

        return view('platforms.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('platforms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlatformRequest $request)
    {
        $inputs = $request->all();

        $platform = Platform::create($inputs);

        if(!$platform) {
            // Lógica para exibir erro
        }

        return redirect()->route('platform.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($platformId)
    {
        $platform = Platform::findOrFail($platformId);

        return view('platforms.edit', compact('platform'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlatformRequest $request, $platformId)
    {
        $platform = Platform::findOrFail($platformId);
        $inputs = $request->all();

        $platform->update($inputs);

        return redirect()->route('platform.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $platformId)
    {
        if(!$request->ajax())
            abort(403);

        $platform = Platform::destroy($platformId);

        if($platform) {
            return response()->json(['status' => 'success', 'platformId' => $platformId]);
        }
        return response()->json(['status' => 'fail', 'platformId' => $platformId]);
    }
}
