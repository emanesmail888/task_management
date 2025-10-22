<?php
namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'query' => 'required|string|min:1',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ];
    }
}
