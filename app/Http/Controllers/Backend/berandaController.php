<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class berandaController extends Controller
{
    public function index()
    {
        
        if(Auth::user()->level==2):
        return view('backend.kadis.index');
        else:
        return view('backend.beranda.index');
        endif;
    }
}
