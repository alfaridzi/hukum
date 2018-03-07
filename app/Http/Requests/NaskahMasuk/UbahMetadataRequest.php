<?php

namespace App\Http\Requests\NaskahMasuk;

use Illuminate\Foundation\Http\FormRequest;

class UbahMetadataRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');
        return [
            'jenis_naskah' => 'required|integer',
            'tanggal_naskah' => 'required|date',
            'nomor_naskah' => 'required|string',
            'nomor_agenda' => 'string|unique:tbl_naskah,nomor_agenda,'.$id.',id_naskah',
            'hal' => 'required|string',
            'tingkat_urgensi' => 'required|integer',
            'perkembangan' => 'required|integer',
            'sifat_naskah' => 'required|integer',
            'kategori_arsip' => 'required|boolean',
            'akses_publik' => 'required|boolean',
            'media_arsip' => 'required|integer',
            'bahasa' => 'required|integer',
            'isi_ringkas' => 'string|nullable',
            'vital' => 'required|integer',
            'jumlah' => 'integer',
            'satuan_unit' => 'integer',
            'lokasi_fisik' => 'string|nullable',
        ];
    }
}
