<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersetujuanStaff extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_barang' => 'required',
            'catatan_staff_ahli' => 'nullable',
            'kode_barang' => 'required',
            'unit_kerja' => 'required',
            'tanggal_maintenance_lanjutan' => 'required',
            'tanggal_maintenance' => 'required',
            'harga_vendor' => 'required'
        ];
    }
}
