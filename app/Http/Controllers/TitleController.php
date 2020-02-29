<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Title;
use Illuminate\Support\Facades\Cache;
class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $t_name = request()->t_name;
        $t_type = request()->t_type;
        $where =[];
        if($t_name){
           $where[]=['t_name','like',"%$t_name%"];
        }
        if($t_type){
           $where[]=['t_type','=',$t_type];
        }
        $data = Cache::get('data');
        if(!$data){
          echo "db";
          $data = Title::where($where)->paginate(1);
          cache(['data'=>$data,60*60*24]);
        }
          
        return view('title.list',['data'=>$data,'t_name'=>$t_name,'t_type'=>$t_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('title.create');
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
        //  dd($data);
        //上传文件
        $data['t_time'] = time();
        if($request->hasFile('t_img')){
          $data['t_img'] = $this->upload('t_img');
        }
        $validator = Validator::make($data,[
            't_name' => 'required|unique:title|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]+$/u',
            't_author' => 'required',
             't_email' => 'required',
             't_gjz' => 'required',
             't_desc' => 'required',

           ],[
            't_name.required'=>'名称不能为空',
           
            't_name.unique'=>'名称已存在',
            't_name.regex'=>'数字字母下划线中文组成',

             't_name.regex'=>'中文数字字母下划线长度2-12位组成',
            't_author.required'=>'作者不能为空',
            't_email.required'=>'email不能为空',
             't_gjz.required'=>'关键字不能为空',
            't_desc.required'=>'网页描述不能为空'

         ]);
         if($validator->fails()){
           return redirect('title/create')
           ->withErrors($validator)
           ->withInput();
         }
         $res = Title::insert($data);
         if($res){
            return redirect('/title');
         }
    }

    public function upload($filename){
        //判断上传是否有错误
        if(request()->file($filename)->isValid()){
           //接受值
          $photo = request()->file($filename);
           //上传
           $store_result = $photo->store('uploads');
           return $store_result;
       }
       exit('未获取到上传文件或上传过程出错');
   }


       function checkOnly(){
           $title = request()->title;
           $t_id = request()->t_id;
           if($title){
             $where[] = ['title','=',$title];
           }
           if($t_id){
             $where[] = ['t_id','!=',$t_id];
           }
            $count = Title::where(['t_name'=>$title])->count();
            echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
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
        $res = Title::find($id);

        return view('title.edit',['res'=>$res]);
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
        if($request->hasFile('t_img')){
           $data['t_img'] = $this->upload('t_img');
         }
         $validator = Validator::make($data,[
            't_name' => 'required|unique:title|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]+$/u',
            't_author' => 'required',
             't_email' => 'required',
             't_gjz' => 'required',
             't_desc' => 'required',

           ],[
            't_name.required'=>'名称不能为空',
           
            't_name.unique'=>'名称已存在',
            't_name.regex'=>'数字字母下划线中文组成',

             't_name.regex'=>'中文数字字母下划线长度2-12位组成',
            't_author.required'=>'作者不能为空',
            't_email.required'=>'email不能为空',
             't_gjz.required'=>'关键字不能为空',
            't_desc.required'=>'网页描述不能为空'

         ]);
         if($validator->fails()){
           return redirect('title/edit')
           ->withErrors($validator)
           ->withInput();
         }
         //DB操作修改
       // $res = DB::table('people')->where('p_id',$id)->update($data);
       //ORm操作修改
       $res = Title::where('t_id',$id)->update($data);
       if($res!==false){
          return redirect('/title');
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
         
        $res = Title::where('t_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);

        }
    }
}
