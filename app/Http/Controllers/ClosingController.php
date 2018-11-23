<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Close;

class ClosingController extends Controller
{
    public function getClosings() {
        return DB::table('closings')->orderBy('id', 'DESC')->get();
    }

    public function postClosing() {
        $close = new Close();
        $close->save();
    }
}
