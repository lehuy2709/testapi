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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|min:6|max:32|email',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Bắt buộc nhập email',
            'email.min' => 'Email tối thiểu 6 kí tự',
            'email.email' => 'Email phải đúng định dạng',
            'email.max' => 'Email không quá 32 kí tự',
            'password.required' => 'Bắt buộc nhập password',
            'password.min' => 'Password tối thiểu 6 kí tự',

        ];
    }
}
