<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
            'email' => 'required|string|email',
            'customer_name' => 'required|string',
            'phone_number' => 'required|digits:10',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email bắt buộc nhập',
            'email.string' => 'Email không định dạng không hợp lệ',
            'email.email' => 'Email không định dạng không hợp lệ',
            'customer_name.required' => 'Họ tên bắt buộc nhập',
            'phone_number.required' => 'Số điện thoại bắt buộc nhập',
            'phone_number.digits' => 'Số điện thoại không hợp lệ',
            'address.required' => 'Địa chỉ bắt buộc nhập'
        ];
    }
}
