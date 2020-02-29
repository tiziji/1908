<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('user.list',['data'=>$data]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        if($request->hasFile('u_img')){
            $data['u_img'] = upload('u_img');
          }
        $validator = Validator::make($data,[
            'u_name' => 'required|unique:user|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]+$/u',
            'u_pwd' => 'required',
            'u_ped' => 'required',

             'u_tel' => 'required',
             'u_email' => 'required',

           ],[
            'u_name.required'=>'管理员名称不能为空',
           
            'u_name.unique'=>'名称已存在',

             'u_name.regex'=>'中文数字字母下划线长度2-12位组成',
            'u_pwd.required'=>'密码不能为空',
            'u_ped.required'=>'确认密码不能为空',
            'u_tel.required'=>'手机号不能为空',
             'u_email.required'=>'邮箱不能为空',
           

         ]);
         if($validator->fails()){
            return redirect('user/create')
            ->withErrors($validator)
            ->withInput();
          }
          $data['u_pwd'] = md5($data['u_pwd']);
          $res = User::insert($data);
          if($res){
             return redirect('/user');
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res = User::find($id);
      
        return view('user/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        if($request->hasFile('u_img')){
           $data['u_img'] = upload('u_img');
         }
         $res = User::where('u_id',$id)->update($data);
         if($res!==false){
            return redirect('/user');
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         
        $res = User::where('u_id',$id)->delete();
        if($res){
            
            return redirect('/user');

        }
    }
}
