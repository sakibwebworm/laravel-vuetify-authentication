<?php

namespace App\Http\Controllers;

use App\Http\Requests\PotentialCustomerRequest;
use App\PotentialCustomer;
use Illuminate\Http\Request;

class PotentialCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(PotentialCustomerRequest $request)
    {
        //
        return PotentialCustomer::create([
            'email' => $request['email'],
            'name' => $request['name']
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PotentialCustomer  $potentialCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(PotentialCustomer $potentialCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PotentialCustomer  $potentialCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(PotentialCustomer $potentialCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PotentialCustomer  $potentialCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PotentialCustomer $potentialCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PotentialCustomer  $potentialCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PotentialCustomer $potentialCustomer)
    {
        //
    }
}
