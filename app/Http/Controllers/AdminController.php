<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;

class AdminController extends Controller
{
    public function admin_index(){
        return view('admin.home');
    }

    public function medication(Request $request){

        Medication::create([
            'name' => $request->name,
            'usage' => $request->usage,
        ]);
        return back();
    }
}
