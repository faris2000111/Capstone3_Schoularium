<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:admin,nip,' . $this->id,
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:admin,email,' . $this->id,
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ];
    }
}
