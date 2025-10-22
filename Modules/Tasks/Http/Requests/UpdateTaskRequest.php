<?php
namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|in:pending,in_progress,done',
            'due_date' => 'sometimes|required|date',
            'priority' => 'sometimes|in:low,medium,high',
        ];
    }
}
