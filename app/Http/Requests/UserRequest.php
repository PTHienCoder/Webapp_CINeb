<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
        {
            return [
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|max:50',
                'repassword' => 'required|min:6|same:password',
                // 'phone' => 'bail|required|numeric|digits_between:9,11',

            ];
        }

        public function messages()
        {
            return [
                'required' => ':attribute không được để trống',
                'max' => ':attribute độ dài không được lớn hơn :max',
                'email' => ':attribute phải là email',
                'unique' => ':attribute đã tồn tại',
                'same' => ':attribute Mật khẩu nhập lại không trùng khớp',
                // 'phone' => ':attribute Vui Lòng nhập SDT chính xác',
            ];
        }
        public function attributes()
        {
            return [
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'repassword' => 'Xác Nhận Mật khẩu',
                // 'phone' => 'Số Điện hoại',
            ];
        }
}
