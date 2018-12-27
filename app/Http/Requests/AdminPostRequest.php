<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class AdminPostRequest extends FormRequest
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
        $rules = [];

        $dataRequest = $this->request->all();
        Session::push('post_form_data', $dataRequest);
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):
            case 'POST':

                switch ($currentAction){

                    case 'addEdit':
                        if(isset($dataRequest['id_doanh_nghiep'])){
                            $rules = [
                            ];

                        }

                        else
                        {
                            $rules = [
                            ];

                        }
                        break;
                    case 'delete':
                        $rules = [
//
                        ];
                        break;
                    default: break;
                }
                break;
        endswitch;

        return $rules;
    }
}
