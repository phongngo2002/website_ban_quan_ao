<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
        $rules = [];
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):

            case 'POST':
                switch ($currentAction) {
                    case 'save_create':
                        $rules = [
                            'code' => 'required|unique:vouchers',
                            'discount' => 'required|numeric',
                            'title' => 'required',
                            'start_time' => 'required|before_or_equal:end_time',
                            'end_time' => 'required'
                        ];
                        break;
                    case 'save_update':
                        $rules = [
                            'code' => 'required',
                            'discount' => 'required|numeric',
                            'title' => 'required',
                            'start_time' => 'required|before_or_equal:end_time',
                            'end_time' => 'required'
                        ];
                        break;
                    default:
                        break;
                }
                break;

            default:
                break;
        endswitch;

        return $rules;
    }

    public function messages()
    {

        return [
            'code.required' => 'Mã voucher không được bỏ trống',
            'code.unique' => 'Mã code đã tồn tại.Vui lòng thử 1 mã code khác.',
            'discount.required' => 'Số phần trăm giảm giá không được để trống',
            'discount.numeric' => 'Số phần trăm giảm gía bắt buộc là số',
            'title.required' => 'Tiêu đề bắt buộc nhập',
            'start_time.required' => 'Thời gian bắt đầu bắt buộc nhập',
            'start_time.before_or_equal' => 'Thời gian bắt đầu phải sớm hơn thời gian kết thúc',
            'end_time.required' => 'Thời gian kết thúc bắt buộc nhập'
        ];
    }
}
