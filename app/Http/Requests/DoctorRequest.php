<?php
/*
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
                        'name' => ['required', 'unique:doctors,name', 'min:2', 'string'],
                    ];
                }
                   break;
            case 'update':
                {
                    return [
                        'name' => ['required', 'min:2', 'string', 'unique:doctors,name,' . $this->doctor . ',id'],
                    ];
                }
                    break;
            default:break;
        }

    }

    // protected function prepareForValidation()
    // {
    //     dd($this->doctor);
    // }

    public function messages()
    {
        return [
            'name.required' => 'nama dokter wajib diisi',
            'name.unique' => 'nama dokter tidak boleh sama',
            'name.min' => 'nama dokter minimal 2 karakter',
        ];
    }
}
