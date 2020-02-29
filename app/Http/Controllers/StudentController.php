<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Validation\Rule;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $s_name = request()->s_name;
         $s_class = request()->s_class;
         $where =[];
         if($s_name){
            $where[]=['s_name','like',"%$s_name%"];
         }
         if($s_class){
            $where[]=['s_class','=',$s_class];
         }
         $res = DB::table('student')->where($where)->select('*')->paginate(2);
        return view('student.list',['res'=>$res,'s_name'=>$s_name,'s_class'=>$s_class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
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
        //dd($data);
        $validator = Validator::make($data,[
                's_name' => 'required|unique:student|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2-12}$/u',
                's_class' => 'required',
                 's_goods' => 'required|numeric|between:0,100',
               ],[
                's_name.required'=>'名称不能为空',
                's_name.unique'=>'名称已存在',
                's_name.between'=>'数字字母下划线长度2-12位组成',
                's_class.required'=>'班级不能为空',
                's_goods.required'=>'成绩不能为空',
                's_goods.numeric'=>'成绩必须为数字',
                's_goods.between'=>'不能超过100分'

             ]);
             if($validator->fails()){
               return redirect('student/create')
               ->withErrors($validator)
               ->withInput();
             }
        $res = DB::table('student')->insert($data);
        if($res){
           return redirect('student');
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
        $data = DB::table('student')->where('s_id',$id)->first();
    //    dd($data);
        return view('student/show',['data'=>$data]);
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

        //第三中
        $validator = Validator::make($data,[
            's_name' => [
         'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
          Rule::unique('student')->ignore($id,'s_id'),
       ],
            's_class' => 'required',
             's_goods' => 'required|numeric|between:0,100',
           ],[
            // 's_name.required'=>'名称不能为空',
            's_name.unique'=>'名称已存在',
            's_name.regex'=>'中文数字字母下划线长度2-12位组成',
            's_class.required'=>'班级不能为空',
            's_goods.required'=>'成绩不能为空',
            's_goods.numeric'=>'成绩必须为数字',
            's_goods.between'=>'不能超过100分'

         ]);
         if($validator->fails()){
           return redirect('student/create')
           ->withErrors($validator)
           ->withInput();
         }

         //第一中
        //  $request->validate([
        //    [ 'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2-12}$/u',
        //     Rule::unique('student')->ignore($id,'s_id'),
        //  ],
        //      's_goods' => 'required|numeric|between:0,100',
        //    ],[
        //     's_name.unique'=>'名称已存在',
        //     's_name.between'=>'数字字母下划线长度2-12位组成',
        //     's_goods.required'=>'成绩不能为空',
        //     's_goods.numeric'=>'成绩必须为数字',
        //     's_goods.between'=>'不能超过100分'

        //  ]);
        $res = DB::table('student')->where('s_id',$id)->update($data);
        if($res!==false){
           return redirect('/student');
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
        $res = DB::table('student')->where('s_id',$id)->delete();
        if($res){
           return redirect('/student');
        }
    }
}
