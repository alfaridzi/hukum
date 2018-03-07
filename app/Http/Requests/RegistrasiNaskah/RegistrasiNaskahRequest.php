<?php

namespace App\Http\Requests\RegistrasiNaskah;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Pengaturan\Ekstensi;

class RegistrasiNaskahRequest extends FormRequest
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
        $dataEkstensi = Ekstensi::all('jenis_ekstensi')->toArray();
        $ekstensi = implode(',', array_pluck($dataEkstensi, 'jenis_ekstensi'));
        if ($this->tipe_registrasi == 5) {
            return [
                'jenis_naskah' => 'required|integer',
                'tanggal_naskah' => 'required|date',
                'nomor_naskah' => 'required|string',
                'nomor_agenda' => 'string|unique:tbl_naskah,nomor_naskah',
                'hal' => 'required|string',
                'asal_naskah' => 'required|string',
                'tingkat_urgensi' => 'required|integer',
                'file_upload.*' => 'mimes:'.$ekstensi.'|max:15000',
                'tipe_registrasi' => 'required|integer',
            ];
        }else{
            return [
                'jenis_naskah' => 'required|integer',
                'tanggal_naskah' => 'required|date',
                'nomor_naskah' => 'required|string',
                'nomor_agenda' => 'string|unique:tbl_naskah,nomor_naskah',
                'hal' => 'required|string',
                'asal_naskah' => 'required|string',
                'tingkat_urgensi' => 'required|integer',
                'kepada' => 'required|integer',
                'tembusan' => 'integer|nullable',
                'file_upload.*' => 'mimes:'.$ekstensi.'|max:15000',
                'tipe_registrasi' => 'required|integer',
            ];
        }
    }
}
