<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BencanaRequest extends FormRequest
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
            
            'jenis_bencana' => ['required', 'exists:bencanas,jenis_bencana'],
            'tanggal' => ['required', 'date'],
            'province_code' => ['required', 'string'],
            'regency_code' => ['required', 'string'],
            'district_code' => ['required', 'string'],
            'village_codes' => ['required', 'array'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }
}
