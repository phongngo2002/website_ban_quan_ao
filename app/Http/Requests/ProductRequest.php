<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                            'product_name' => 'required|unique:products',
                            'desc' => 'required',
                            'short_desc' => 'required',
                            'price' => 'required',
                            'SKU' => 'required|unique:products',
                            'img' => 'required',
                            'in_stock' => 'required',
                            'weight' => 'required',
                            'dimensions' => 'required',
                            'materials' => 'required',
                            'sizes' => 'required',
                            'colors' => 'required',
                            'photo_gallery' => 'required'
                        ];
                        break;
                    case 'save_update':
                        $rules = [
                            'product_name' => 'required',
                            'desc' => 'required',
                            'short_desc' => 'required',
                            'price' => 'required',
                            'SKU' => 'required',
                            'in_stock' => 'required',
                            'weight' => 'required',
                            'dimensions' => 'required',
                            'materials' => 'required',
                            'sizes' => 'required',
                            'colors' => 'required',
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
            'product_name.required' => 'Tên sản phẩm bắt buộc nhập',
            'product_name.unique' => 'Tên sản phẩm đã tồn tại.Vui lòng thử lại',
            'desc.required' => 'Mô tả chi tiết bắt buộc nhập',
            'short_desc.required' => 'Mô tả ngắn bắt buộc nhập',
            'price.required' => 'Giá sản phẩm bắt buộc nhập',
            'SKU.required' => 'Mã sản phẩm bắt buộc nhập',
            'SKU.unique' => 'Mã sản phẩm đã tồn tại.Vui lòng thử lại',
            'img.required' => 'Ảnh đại diện bắt buộc chọn',
            'in_stock.required' => 'Số lượng hàng trong kho bắt buộc nhập',
            'weight.required' => 'Khối lượng sản phẩm bắt buộc nhập',
            'dimensions.required' => 'Kích thước sản phẩm bắt buộc nhập',
            'materials.required' => 'Chất liệu sản phẩm bắt buộc nhập',
            'sizes.required' => 'Thuộc tính kích cỡ bắt buộc nhập',
            'colors.required' => 'Thuộc tính màu sắc sản phẩm bắt buộc nhập',
            'photo_gallery.required' => 'Bô sưu tập ảnh bắt buộc chọn'
        ];
    }
}
