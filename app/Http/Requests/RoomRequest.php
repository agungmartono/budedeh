<?php
/*
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
        $arr = explode('@', $this->route()->getActionName());
        $method = $arr[1];  // The controller method
    
        switch ($method) 
        {
            case 'store':
                {
                    return [
                        'installation' => ['required', 'boolean'],
                        'name' => ['required', 'unique:rooms,name', 'min:2', 'string'],
                    ];
                }
                   break;
            case 'update':
                {
                    return [
                        'installation' => ['required', 'boolean'],
                        'name' => ['required', 'min:2', 'string', 'unique:rooms,name,' . $this->room . ',id'],
                    ];
                }
                    break;
            default:break;
        }

    }

    public function messages()
    {
        return [
            'installation.required' => 'Wajib Diisi',
            'installation.boolean' => 'Harap Pilih Pilihan',
            'name.required' => 'nama ruangan wajib diisi',
            'name.unique' => 'nama ruangan tidak boleh sama',
            'name.min' => 'nama ruangan minimal 2 karakter',
        ];
    }
}
