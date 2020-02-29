<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Validator;
use Illuminate\Validation\Rule;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::get();
        $data = CreateTree($data);

        return view('category/show',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        $data = CreateTree($data);
        return view('category/create',['data'=>$data]);
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
         
         $validator = Validator::make($data,[
            'c_name' => 'required|unique:category|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]+$/u',
            'c_desc' => 'required',

           ],[
            'c_name.required'=>'分类名称不能为空',
           
            'c_name.unique'=>'名称已存在',
            'c_name.regex'=>'数字字母下划线中文组成',

            'c_desc.required'=>'分类描述不能为空',

         ]);
         if($validator->fails()){
           return redirect('category/create')
           ->withErrors($validator)
           ->withInput();
         }
         $res = Category::insert($data);
       if($res){
          return redirect('/category');
       }
    }

    public function checkOnly(){
        $c_name = request()->c_name;
        $c_id = request()->c_id;
       $where =[];
        if($c_name){
            $where[] = ['c_name','=',$c_name];
          }
          if($c_id){
            $where[] = ['c_id','!=',$c_id];
          }
           
           $count = Category::where($where)->count();
           
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
        $data = Category::all();
        $data = CreateTree($data);
        $res = Category::find($id);
        if($res){
            return view('category/edit',['res'=>$res,'data'=>$data]);

        }
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
         
        $validator = Validator::make($data,[
           'c_name' => [
               'regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]+$/u',
               Rule::unique('category')->ignore($id,'c_id'),
            ],
           'c_desc' => 'required',

          ],[
          
          
           'c_name.unique'=>'名称已存在',
           'c_name.regex'=>'数字字母下划线中文组成',

           'c_desc.required'=>'分类描述不能为空',

        ]);
        if($validator->fails()){
          return redirect('category/edit/'.$id)
          ->withErrors($validator)
          ->withInput();
        }
        $res = Category::where('c_id',$id)->update($data);
        if($res!==false){
           return redirect('/category');
        }  
        // echo $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Category::where('c_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);

        }
    }
}
