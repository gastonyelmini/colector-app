<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function getAuthUser() {
        return Auth::user()->username;
    }

    public function getisLoader() {
        $returnString = '';
        if(Auth::user()->is_admin || Auth::user()->is_loader) {
            $returnString = 'true';
        } else {
            $returnString = 'false';
        }
        return $returnString;
    }
}
