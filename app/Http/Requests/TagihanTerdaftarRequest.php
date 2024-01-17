<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagihanTerdaftarRequest extends FormRequest
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
            'no_tagihan' => 'required|string|unique:tagihan_terdaftars',
            'nama_tagihan' => 'required|string',
            'tanggal_bayar' => 'required|string',
            'bulan_bayar' => 'string',
            'kota_kabupaten' => 'string',
        ];
    }
}
