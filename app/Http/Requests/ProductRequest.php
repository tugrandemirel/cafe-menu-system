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

    public function ProductStoreRules()
    {
        return [
            'name' => ['required', 'string', 'max:60'],
            'image' => ['required', 'string', 'max:60'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'status' => ['required', 'numeric'],
            'parent_id' => ['required', 'numeric'],
        ];
    }

    public function rules()
    {
        if ($this->route('admin.product.store'))
            return $this->ProductStoreRules();

        return [];
    }
}
