<?php

namespace App\Http\Controllers;

use App\GoodType;
use Illuminate\Http\Request;

class GoodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('good-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GoodType  $goodType
     * @return \Illuminate\Http\Response
     */
    public function show(GoodType $goodType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GoodType  $goodType
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodType $goodType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoodType  $goodType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodType $goodType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GoodType  $goodType
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodType $goodType)
    {
        //
    }
}
