<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingStoreRequest;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index(){
        return response()->json([
            'setting' => Setting::first(),
        ]);
    }

    public function store(SettingStoreRequest $request){
        return response()->json(Setting::create($request->all()));
        
    }

    public function update(SettingStoreRequest $request,Setting $setting){
        return response()->json($setting->update($request->all()));
    }
}
