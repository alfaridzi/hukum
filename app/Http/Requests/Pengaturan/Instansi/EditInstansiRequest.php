<?php

namespace App\Http\Requests\Pengaturan\Instansi;

use Illuminate\Foundation\Http\FormRequest;

class EditInstansiRequest extends FormRequest
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
            'kode_instansi' => 'required|string|unique:tbl_instansi,kode_instansi,'.$id.',id_instansi',
            'nama_instansi' => 'required|string',
            'nama_lain'     => 'string',
            'tipe_instansi' => 'string',
            'tanggal_keberadaan' => 'required|date',
            'detail'        => 'required|string',
            'mandat'        => 'required|string',
            'status'        => 'required|boolean'
        ];
    }
}
