<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brand::get();
        return view('brand.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
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
        // dd($data);
        //上传文件
        if($request->hasFile('b_logo')){
          $data['b_logo'] = $this->upload('b_logo');
        }
        $res = Brand::all($data);
        if($res){
           return redirect('/brand');
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
        $res = Brand::find($id);

        return view('brand.edit',['res'=>$res]);
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
        if($request->hasFile('b_logo')){
           $data['b_logo'] = $this->upload('b_logo');
         }
         //DB操作修改
       // $res = DB::table('people')->where('p_id',$id)->update($data);
       //ORm操作修改
       $res = Brand::where('b_id',$id)->update($data);
       if($res!==false){
          return redirect('/brand');
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
        $res = Brand::where('b_id',$id)->delete();
        if($res){
            return redirect('/brand');
          } 
    }
}
