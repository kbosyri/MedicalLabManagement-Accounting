<?php

namespace App\Http\Requests\Rewards;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class AddRewardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Auth::user()->role)
        {
            if(Auth::user()->role->finance)
            {
                return true;
            }
        }
        return Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date'=>['required','date'],
            'amount'=>['required','numeric'],
            'reason'=>['required'],
            'staff_id'=>['required'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'message'=>'يوجد خطأ في القيم المدخلة',
            'errors'=>$validator->errors()
        ],400));
    }
}
