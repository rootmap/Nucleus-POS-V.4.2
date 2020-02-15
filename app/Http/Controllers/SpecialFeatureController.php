<?php

namespace App\Http\Controllers;

use App\SpecialFeature;
use Illuminate\Http\Request;

class SpecialFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Special Feature";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        return view('apps.pages.special_feature.special-feature');
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
     * @param  \App\SpecialFeature  $specialFeature
     * @return \Illuminate\Http\Response
     */
    public function show(SpecialFeature $specialFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpecialFeature  $specialFeature
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecialFeature $specialFeature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpecialFeature  $specialFeature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecialFeature $specialFeature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpecialFeature  $specialFeature
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialFeature $specialFeature)
    {
        //
    }
}
