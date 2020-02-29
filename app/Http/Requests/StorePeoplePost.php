<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeoplePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:people|max:12|min:2',
            'age' => 'required|integer|between:1,130',
        ];
    }
    public function messages(){
        return [
                   'username.required'=>'名称不能为空',
                   'username.unique'=>'名称已存在',
                   'username.max'=>'名称长度不超过12位',
                   'username.min'=>'名字长度不小于2位',
                   'age.required'=>'年龄不能为空',
                   'age.integer'=>'年龄必须为数字',
                   'age.between'=>'年龄数据不合法',
        ];
    }
}
