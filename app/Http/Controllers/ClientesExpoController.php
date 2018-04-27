<?php

namespace App\Http\Controllers;

use App\ClientesExpo;
use Illuminate\Http\Request;

class ClientesExpoController extends Controller
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
    public function store(Request $request)
    {
        $post = ClientesExpo::create($request->all());

        return "nuevo cliente registrado";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientesExpo  $clientesExpo
     * @return \Illuminate\Http\Response
     */
    public function show(ClientesExpo $clientesExpo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientesExpo  $clientesExpo
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientesExpo $clientesExpo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientesExpo  $clientesExpo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientesExpo $clientesExpo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientesExpo  $clientesExpo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientesExpo $clientesExpo)
    {
        //
    }
}
