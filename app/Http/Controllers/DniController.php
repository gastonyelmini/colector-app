<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StroreDniRequest;
use App\Dni;
use DB;
use Carbon\Carbon;

use Auth;

class DniController extends Controller
{
    public function index()
    {
        return DB::table('dnis')->get();
    }

    public function showMissings()
    {
        return view('missings');
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
        $oldDnis = DB::table('nuevos_dnis')->get();

        foreach($oldDnis as $r){
            $newDni = new Dni();
            $newDni->dni = $r->DOCUMENTO;
            $newDni->registed_by = $r->USER;
            $newDni->name_lastname = $r->APELLIDO_NOMBRE;
            $newDni->address = $r->DOMICILIO;
            $newDni->school = $r->ESCUELA;

            $newDni->save();
        }
    }

    public function getRemainingDnis() {
        $lastTwoClosingRecords = DB::table('closings')->take(2)->orderBy('created_at', 'DESC')->get();

        //Tres registros necesarios
        $penultimateDate = $lastTwoClosingRecords->toArray()[1]->created_at;
        $lastDate = $lastTwoClosingRecords->toArray()[0]->created_at;
        $todayDate = Carbon::now();

        //Esto es el registro anterior
        $dniListP1 = DB::table('dnis')
            ->where('created_at','<=',$lastDate)
            ->where('created_at','>=',$penultimateDate)
            ->get();
        
        //Aca van registrando los que vinieron luego del registro anterior
        $dniListP2 = DB::table('dnis')
            ->where('created_at','<=',$todayDate)
            ->where('created_at','>=',$lastDate)
            ->get();

        
        foreach($dniListP1 as $key => $p1value) {
            foreach($dniListP2 as $p2value) {
                if($p2value->dni == $p1value->dni) {
                    unset($dniListP1[$key]);
                    break;
                }
            }
        }

        return json_encode($dniListP1);

    }
}
