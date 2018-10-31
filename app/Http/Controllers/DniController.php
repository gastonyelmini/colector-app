<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StroreDniRequest;
use App\Dni;

class DniController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StroreDniRequest $request)
    {
        Dni::create($request->all());
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
