@foreach($data as $k=>$v)
       <tr @if($k%2==0) class="success" @else class="active" @endif>
           <td>{{$v->p_id}}</td>
           <td>{{$v->username}}</td>
           <td>{{$v->age}}</td>
           <td>{{$v->card}}</td>
           <td>@if($v->head)<img src="{{env('UPLOAD_URL')}}{{$v->head}}" width="30" height="30">@endif</td>
           <td>{{$v->is_hubei==1?'√':'×'}}</td>
           <td>{{date('Y-m-d,h:i:s',$v->add_time)}}</td>
           <td> <a href="{{url('people/edit/'.$v->p_id)}}" class="btn btn-info">编辑</a> <a href="{{url('people/destroy/'.$v->p_id)}}" class="btn btn-danger">删除</a></td>
       </tr>
       
       @endforeach
       <tr><td colsapn="7">{{$data->appends(['username'=>$username])->links()}}</td></tr>