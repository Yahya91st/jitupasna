<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormat1Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // dd($this->input('harga_satuan')); 
        
        $details = $this->input('details', []);
        $hargaSatuan = $this->input('harga_satuan', []);

        foreach ($details as $key => $detail) {

            $kategori = $detail['kategori'] ?? null;

            if ($kategori && isset($hargaSatuan[$kategori])) {
                $details[$key]['harga_satuan'] = $hargaSatuan[$kategori];
            }
        }

        $this->merge([
            'details' => $details
        ]);

    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama_kampung' => 'required|string|max:255',

            'nama_distrik' => 'required|string|max:255',

            'bencana_id' => 'required|exists:bencanas,id',

            'details' => 'required|array|min:1',

            // 'details.*.kriteria_id' => 'required|exists:kriteria_kerusakans,id',

            'details.*.kategori' => 'required|string|max:255',

            'details.*.sub_kategori' => 'nullable|string|max:255',

            'details.*.dimensi' => 'nullable|numeric|min:0',

            'details.*.tingkat_kerusakan' =>
                'required|in:ringan,sedang,berat,hancur_total',

            'details.*.jumlah' =>
                'required|numeric|min:0',

            'details.*.harga_satuan' =>
                'required|numeric|min:0',

            'details.*.satuan' =>
                'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'bencana_id.required' => 'Bencana wajib dipilih.',
            'bencana_id.exists' => 'Bencana tidak ditemukan.',

            'details.required' => 'Minimal satu data harus diisi.',
            'details.array' => 'Format detail tidak valid.',

            'details.*.kriteria_id.required' => 'Kriteria kerusakan wajib diisi.',
            'details.*.kriteria_id.exists' => 'Kriteria kerusakan tidak valid.',

            'details.*.tingkat_kerusakan.in' =>
                'Tingkat kerusakan tidak valid.',

            'details.*.jumlah.required' =>
                'Jumlah wajib diisi.',

            'details.*.harga_satuan.required' =>
                'Harga satuan wajib diisi.',
        ];
    }
}
