<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTask extends FormRequest
{
    protected $errorBag = 'create';

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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'project' => ['required', 'integer', Rule::exists('projects', 'id')->whereIn('id', request()->user()->projects()->pluck('id')->toArray())]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '任务名称是必须的',
            'name.max' => '任务名称的长度超出的最大字符限制：255',
            'project.required' => '没有提交当前任务所属项目的id',
            'project.integer' => '所提交的项目id无效（非整数）',
            'project.exists' => '所提交的项目id无效（不存在）',
        ];
    }
}
