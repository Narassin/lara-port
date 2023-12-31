<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index() {
        $payloads = Info::select('*')
        ->orderBy('created_at','desc')
        ->get();

        return view('indexpage',compact(
            'payloads'
        ));
    }

    public function store(Request $request){
        // dd($request->all());

        Info::create([
            'name'=>$request->name,
            'port'=>$request->port,
        ]);


        // Direct approach
        // DB::table('users')->insert([
        //     'email' => 'kayla@example.com',
        //     'votes' => 0
        // ]);


        return redirect()->route('info.index');
    }

    public function read($id){

        $dataload = Info::select('*')
        ->where('id',$id)
        ->first();

        return view('readpage',compact(
            'dataload',
        ));
    }

    public function update(Request $request, $id){
        // dd($request->all());

        Info::where('id',$id)->update([
            'name'=>$request->name,
            'port'=>$request->port,
        ]);

        return redirect()->back();
    }

    public function delete(Request $request, $id){
        // dd($request->all());

        Info::where('id',$id)->delete();

        return redirect()->route('info.index');;
    }
}
