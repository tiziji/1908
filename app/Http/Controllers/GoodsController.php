<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use Validator;
use App\Brand;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $g_name = request()->g_name;
         $where = [];
         if($g_name){
            $where[] = ['g_name','like',"%$g_name%"];
         }
         $data = Cache::get('data');
        //  dump($data);
        // $data = Redis::get('data_');
         if(!$data){
           echo "db";
           $pagesize = config('app.pageSize');
            $data = Goods::leftjoin('brand','goods.b_id','=','brand.b_id')->leftjoin('category','category.c_id','=','goods.c_id')->where($where)->paginate( $pagesize);
          //  Cache::put('data',$data,60*60*24*7);
           cache(['data'=>$goods,60*60*24]);
          }
        return view('goods/list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $brand = Brand::all();
         $cate = Category::all();
         $cate = CreateTree($cate);
        return view('goods/create',['brand'=>$brand,'cate'=>$cate]);
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
            'g_name' => 'required|unique:goods|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]+$/u',
           
            'g_price' => 'required',
            'g_num' => 'required',
            'g_desc' => 'required',

           ],[
            'g_name.required'=>'商品名称不能为空',
           
            'g_name.unique'=>'商品名称已存在',
            'g_name.regex'=>'数字字母下划线中文组成',
            
            'g_price.required'=>'商品价格不能为空',
            'g_num.required'=>'商品库存不能为空',
            'g_desc.required'=>'商品描述不能为空',

         ]);
         if($validator->fails()){
           return redirect('goods/create')
           ->withErrors($validator)
           ->withInput();
         }
         if($request->hasFile('g_img')){
            $data['g_img'] = upload('g_img');
          }
          //多文件上传
          if($data['g_imgs']){
            $photos = Moreupload('g_imgs');
            $data['g_imgs'] = implode('|',$photos);
          }
          $data['g_order'] = $this->GoodsOrder();
         $res = Goods::insert($data);
       if($res){
          return redirect('/goods');
       }
    }
    function GoodsOrder(){
        return 'shop'.date('YmdHis').rand(1000,9999);
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
        $brand = Brand::all();
        $res = Goods::find($id);
      
            return view('goods/edit',['res'=>$res,'data'=>$data,'brand'=>$brand]);

        
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
        if($request->hasFile('g_img')){
           $data['g_img'] = $this->upload('g_img');
         }
         //DB操作修改
       // $res = DB::table('people')->where('p_id',$id)->update($data);
       //ORm操作修改
       $res = Goods::where('g_id',$id)->update($data);
       if($res!==false){
          return redirect('/goods');
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
        $res = Goods::where('g_id',$id)->delete();
        if($res){
          return redirect('/goods');
        }
    }
}
