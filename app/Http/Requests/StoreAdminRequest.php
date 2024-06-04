<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:admin',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:8|confirmed',
            'mata_pelajaran' => 'required|string|max:255',
            'tingkat_pendidikan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jabatan' => 'required|string|max:255',
        ];
    }
}
