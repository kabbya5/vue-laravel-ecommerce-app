<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use DB;

class InstallController extends Controller
{
    public function install(){
        if(DB::connection()->getDatabaseName()){
            return view('welcome');
        }else{
            return view('install.configure');
        }
        
    }

    public function storeConfigaration(Request $request){
        
        return back();
    }
}
