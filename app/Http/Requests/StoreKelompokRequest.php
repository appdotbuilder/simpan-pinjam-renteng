<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKelompokRequest extends FormRequest
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
            'nama_kelompok' => 'required|string|max:255|unique:kelompoks,nama_kelompok',
            'alamat' => 'required|string',
            'ketua_kelompok' => 'required|string|max:255',
            'kontak_ketua' => 'required|string|max:20',
            'status' => 'in:aktif,tidak_aktif,pending',
            'keterangan' => 'nullable|string',
            'tanggal_daftar' => 'required|date',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama_kelompok.required' => 'Nama kelompok harus diisi.',
            'nama_kelompok.unique' => 'Nama kelompok sudah terdaftar.',
            'alamat.required' => 'Alamat kelompok harus diisi.',
            'ketua_kelompok.required' => 'Nama ketua kelompok harus diisi.',
            'kontak_ketua.required' => 'Kontak ketua harus diisi.',
            'tanggal_daftar.required' => 'Tanggal pendaftaran harus diisi.',
            'tanggal_daftar.date' => 'Format tanggal tidak valid.',
        ];
    }
}