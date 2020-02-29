<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePeoplePost;
// use DB;
use App\People;
use Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $data = DB::table('people')->select('*')->get();
        //ORM操作
        //$data =People::all();
        //搜索
        
        $username = request()->username??'';
        $where = [];
        if($username){
           $where[] = ['username','like',"%$username%"];
        }
        // Cache::flush();
        $page = request()->page??1;
      // $data = cache('data_'.$page);
        $data = Redis::get('data_'.$page.'_'.$username);
      //  dump($data);
      //  dd($data);
        if(!$data){
           echo "走db";
            $pagesize = config('app.pageSize');
            $data =People::where($where)->orderby('p_id','desc')->paginate($pagesize);
          //   Cache::put('data',$data,60*60*24);
          //  cache(['data_'.$page=>$data],60*60*24);
          $data = serialize($data);
          Redis::setex('data_'.$page.'_'.$username,60,$data);
        }
        $data = unserialize($data);
      //  var_dump(request()->ajax());
         if(request()->ajax()){
            return view('people.ajaxPage',['data'=>$data,'username'=>$username]);

         }
        return view('people.list',['data'=>$data,'username'=>$username]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create');

    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeoplePost $request)
    {
        //第一中
        //  $request->validate([
        //      'username' => 'required|unique:people|max:12|min:2',
        //      'age' => 'required|integer|min:1|max:3',
        //  ],[
        //        'username.required'=>'名称不能为空',
        //        'username.unique'=>'名称已存在',
        //        'username.max'=>'名称长度不超过12位',
        //        'username.min'=>'名字长度不小于2位',
        //        'age.required'=>'年龄不能为空',
        //        'age.integer'=>'年龄必须为数字',
        //        'age.min'=>'年龄数据不合法',
        //        'age.max'=>'年龄数据不合法',

        //  ]);
        $data = $request->except('_token');

        //第三种
        //  $validator = Validator::make($data,[
        //     'username' => 'required|unique:people|max:12|min:2',
        //     'age' => 'required|integer|min:1|max:3'],[
        //         'username.required'=>'名称不能为空',
        //                'username.unique'=>'名称已存在',
        //                'username.max'=>'名称长度不超过12位',
        //                'username.min'=>'名字长度不小于2位',
        //                'age.required'=>'年龄不能为空',
        //                'age.integer'=>'年龄必须为数字',
        //                'age.min'=>'年龄数据不合法1',
        //                'age.max'=>'年龄数据不合法',
            
        //  ]);
        //  if($validator->fails()){
        //    return redirect('people/create')
        //    ->withErrors($validator)
        //    ->withInput();
        //  }
       //上传文件
       if($request->hasFile('head')){
         $data['head'] = $this->upload('head');
       }
        $data['add_time'] = time();
        //DB
        // $res = DB::table('people')->insert($data);

        //ORM操作 save
        // $people = new People;
        // $people->username = $data['username'];
        // $people->age = $data['age'];
        // $people->card = $data['card'];
        // $people->head = $data['head'];
        // $people->add_time = $data['add_time'];
        // $res = $people->save();

        //ORM操作 create  insert
        // $res = People::create($data);
           $res = People::insert($data);
        if( $res ){
        return redirect('/people');
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
     *浏览详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //DB操作
        // $res = DB::table('people')->where('p_id',$id)->first();
        
        //ORM操作
        $res = People::where('p_id',$id)->first();
        return view('people.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *执行页面
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $data = $request->except('_token');
         if($request->hasFile('head')){
            $data['head'] = $this->upload('head');
          }
          //DB操作修改
        // $res = DB::table('people')->where('p_id',$id)->update($data);
        //ORm操作修改
        $res = People::where('p_id',$id)->update($data);
        if($res!==false){
           return redirect('/people');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //DB删除
        // $res = DB::table('people')->where('p_id',$id)->delete();
        //ORM删除
        $res = People::where('p_id',$id)->delete();
        if($res){
          return redirect('/people');
        }
    }
}
