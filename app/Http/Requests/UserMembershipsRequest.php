<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMembershipsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'nullable|in:ALL,ACTIVE,EXPIRED',
            'expiration_in_minutes' => 'nullable|integer'
        ];
    }
}
