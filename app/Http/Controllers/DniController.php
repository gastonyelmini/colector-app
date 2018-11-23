<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StroreDniRequest;
use App\Dni;
use DB;

use Auth;

class DniController extends Controller
{
    public function index()
    {
        return DB::table('dnis')->get();
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

    public function reImportdata() {
        $oldDnis = DB::table('test')->get();

        foreach($oldDnis as $r){
            $newDni = new Dni();
            $newDni->dni = $r->DNI_Referente;
            $newDni->registed_by = Auth::user()->username;
            $newDni->name_lastname = $r->APELLIDO_NOMBRE;
            $newDni->address = $r->DOMICILIO;

            $newDni->save();
        }
    }
}
