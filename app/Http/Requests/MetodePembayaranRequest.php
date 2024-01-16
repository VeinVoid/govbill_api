<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetodePembayaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'no_kartu' => 'required|string',
            'bulan_berlaku' => 'required|string',
            'tahun_berlaku' => 'required|string',
            'cvv' => 'required|string',
        ];
    }
}
