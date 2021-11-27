<?php

namespace Botble\Advs\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class AdvsRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     */
    public function rules()
    {
        return [
            'name'        => 'required|max:120',
            'position' => 'required',
            //  'order'       => 'required|integer|min:0',
            'page' => 'required|integer',
            'status'      => Rule::in(BaseStatusEnum::values()),
        ];
    }
}