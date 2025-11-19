<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreForm3Request extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ubah jika perlu cek hak akses
    }

    public function rules(): array
    {
        return [
            // master fields
            'form_type' => 'required|string|in:form3',
            'bencana_id' => 'nullable|integer|exists:bencana,id',
            'wilayah_bencana' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable|string|max:2000',

            // nama/tanggal OPD
            'nama_opd_1' => 'nullable|string|max:255',
            'tanggal_opd_1' => 'nullable|date',
            'nama_opd_2' => 'nullable|string|max:255',
            'tanggal_opd_2' => 'nullable|date',
            'nama_opd_sosial' => 'nullable|string|max:255',
            'tanggal_opd_sosial' => 'nullable|date',
            'nama_opd_pendidikan' => 'nullable|string|max:255',
            'tanggal_opd_pendidikan' => 'nullable|date',
            'nama_opd_sekretariat' => 'nullable|string|max:255',
            'tanggal_opd_sekretariat' => 'nullable|date',
            'nama_opd_kesehatan' => 'nullable|string|max:255',
            'tanggal_opd_kesehatan' => 'nullable|date',

            // definisi / catatan
            'def_perdagangan_kecil' => 'nullable|string|max:1000',
            'def_perdagangan_besar' => 'nullable|string|max:1000',
            'def_industri_kecil' => 'nullable|string|max:1000',
            'def_industri_besar' => 'nullable|string|max:1000',

            // data dasar (1..68) — numeric counts
            'data_dasar_sebelum_bencana' => 'nullable|array',
            'data_dasar_sebelum_bencana.*' => 'nullable|numeric|min:0',

            // data sekunder umum (textarea)
            'data_sekunder_akibat_bencana_umum' => 'nullable|array',
            'data_sekunder_akibat_bencana_umum.*' => 'nullable|string|max:5000',

            // kelompok-kelompok OPD khusus — terima string (teks jawaban)
            'data_sekunder_akibat_bencana_khusus_opd_1' => 'nullable|array',
            'data_sekunder_akibat_bencana_khusus_opd_1.*' => 'nullable|string|max:2000',

            'data_sekunder_akibat_bencana_khusus_opd_2' => 'nullable|array',
            'data_sekunder_akibat_bencana_khusus_opd_2.*' => 'nullable|string|max:2000',

            'data_sekunder_akibat_bencana_khusus_opd_3' => 'nullable|array',
            'data_sekunder_akibat_bencana_khusus_opd_3.*' => 'nullable|string|max:2000',

            'data_sekunder_akibat_bencana_khusus_opd_4' => 'nullable|array',
            'data_sekunder_akibat_bencana_khusus_opd_4.*' => 'nullable|string|max:2000',

            'data_sekunder_akibat_bencana_khusus_opd_5' => 'nullable|array',
            'data_sekunder_akibat_bencana_khusus_opd_5.*' => 'nullable|string|max:2000',

            'data_sekunder_akibat_bencana_khusus_opd_6' => 'nullable|array',
            'data_sekunder_akibat_bencana_khusus_opd_6.*' => 'nullable|string|max:2000',

            // tambahkan aturan wildcard lain bila ada kelompok tambahan...
        ];
    }

    public function messages(): array
    {
        return [
            'wilayah_bencana.required' => 'Wilayah bencana harus diisi.',
            'data_dasar_sebelum_bencana.*.numeric' => 'Kolom data dasar harus berupa angka.',
            'tanggal.*.date' => 'Format tanggal tidak valid.',
            // tambahkan pesan custom lain bila perlu
        ];
    }
}