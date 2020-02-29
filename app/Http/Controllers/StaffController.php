<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
class StaffController extends Controller
{
    function login(){
        return view('staff.login');
    }
    function add(){
        $data = request()->except('_token');
        $res = Staff::where($data)->first();
        if($res){
            session(['admin'=>$res]);
          return redirect('staff/show/'.$res['id']);
        }
    }
    function show($id){
        $data = Staff::where('id',$id)->first();
        return view('staff/show',['data'=>$data]);
    }
    function list(){
        $data = Staff::all();

        return view('staff/list',['data'=>$data]);
    }
    function delete($id){
      $res = Staff::where('id',$id)->delete();
      if($res){
          return redirect('/staff');
      }
    }
    function addshow(){
        return view('staff/addshow');
    }
}
