<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // điều kiện để phân quyền cho việc gửi yêu cầu
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:6|max:50',
            'email' => 'required|email'
        ];
    }

    // hàm định nghĩa các messages lỗi của rules bên trên
    public function messages()
    {
        return [
            'name.required' => 'tên người dùng bắt buộc nhập',
            'name.min' => 'Độ dài tên người dùng tối thiểu 6 kí tự',
            'name.max' => 'Độ dài tên người  dùng tối đa 50 kí tự',
            'email.required' => 'Email người dùng phải đúng định dạng',
            'email.email' => 'Email người dùng phải đúng định dạng'
        ];
    }
}
