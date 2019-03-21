<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            //
            'user_tel'=>'required|unique:user_tel|min:11|max:11|regex:/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/',
            'user_code'=>'required|min：4|max:4',
            'user_pwd'=>'required|min:6|max:16|regex:/^[0-9a-zA-Z]{6,16}$/',
            'user_conpwd'=>'required|min:6|max:16|regex:/^[0-9a-zA-Z]{6,16}$/'
        ];
    }
    /**提示信息*/
    public  function messages()
    {
        return[
            "user_tel.required"=>'手机号不能是空',
            "user_tel.unique"=>'手机号已经存在',
            "user_tel.min"=>'   请填入正确的手机号',
            "user_tel.max"=>'请填入正确的手机号',
            "user_tel.regex"=>'此手机号不存在',
            "user_code.required"=>'验证码不能是空',
            "user_code.min"=>'请写入正确的验证码',
            "user_code.max"=>"请写入正确的验证码",
            "user_pwd.required"=>'密码不能是空',
            "user_pwd.min"=>"密码不能小于6位",
            "user_pwd.max"=>"密码不能大于16位",
            "user_pwd.regex"=>"密码格式不对，只能输入字母和数字",
            "user_conpwd.required"=>'确认密码不能是空',
            "user_conpwd.min"=>"确认密码不能小于6位",
            "user_conpwd.max"=>"确认密码不能大于16位",
            "user_conpwd.regex"=>"确认密码格式不对，只能输入字母和数字",
        ];
    }
}
