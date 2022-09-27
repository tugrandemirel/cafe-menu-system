<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
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

    public function MenuRules()
    {
        return [
            'name' => ['required', 'string', 'max:60'],
            'status' => ['required', 'number'],
        ];
    }

    public function SubMenuRules()
    {
        $data = $this->MenuRules();
        $data['parent_id'] = ['required', 'number'];
        $data['status'] = ['required', 'number'];
        return $data;

    }

    public function rules()
    {
        if ($this->route('admin.menu.store'))
            return $this->MenuRules();
        if ($this->route('admin.menu.submenus.store'))
            return $this->SubMenuRules();

        return [];
    }
}
