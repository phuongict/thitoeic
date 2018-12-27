<?php
/**
 * Created by PhpStorm.
 * User: phamphuong
 * Date: 07/10/2018
 * Time: 20:42
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class AdminCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];

        $dataRequest = $this->request->all();
        Session::push('post_form_data', $dataRequest); // tống vào session trước khi nó post
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):
            case 'POST':

                switch ($currentAction){

                    case 'addEdit':
                        if(isset($dataRequest['id_doanh_nghiep'])){
                            $rules = [
                                'txt_ten_giam_doc' => 'nullable|regex:'.SpxGetPatternHoTenVN(1,50),
                                'txt_ten_nguoi_lien_he' => 'required|regex:'.SpxGetPatternHoTenVN(1,50),
                                'txt_dien_thoai_nguoi_lien_he' => 'required|regex:' . SpxGetPatternNumberOnly(10, 100),
                                'txt_dia_chi' => 'required|regex:'.SpxGetPatternDiaChiVN(5,200),
                                'txt_email_nguoi_lien_he'=>'nullable|regex:'.SpxGetPatternEmailSimple(),
                                'txt_quy_mo'=>'required|integer',
                                'txt_linh_vuc'=>'integer',
                                'txt_ten_doanh_nghiep'=>'required|min:3',
                                'txt_so_hoc_vien'=>'required|integer',
                                'txt_ghi_chu'=>'nullable'
                            ];

                        }

                        else
                        {
                            $rules = [
                                'txt_ten_giam_doc' => 'nullable|regex:'.SpxGetPatternHoTenVN(1,50),
                                'txt_ten_nguoi_lien_he' => 'required|regex:'.SpxGetPatternHoTenVN(1,50),
                                'txt_dien_thoai_nguoi_lien_he' => 'required|regex:' . SpxGetPatternNumberOnly(10, 100),
                                'txt_dia_chi' => 'required|regex:'.SpxGetPatternDiaChiVN(5,200),
                                'txt_email_nguoi_lien_he'=>'nullable|regex:'.SpxGetPatternEmailSimple(),
                                'txt_quy_mo'=>'required|integer',
                                'txt_linh_vuc'=>'integer',
                                'txt_ten_doanh_nghiep'=>'required|min:3',
                                'txt_so_hoc_vien'=>'required|integer',
                                'txt_ghi_chu'=>'nullable'
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


    public function messages()
    {
        return [

            'txt_ten_giam_doc.regex' => 'Họ tên giám đốc không hợp lệ. Họ tên phải từ 5 - 50 ký tự!',
            'txt_ten_nguoi_lien_he.regex' => 'Họ tên người liên hệ. Họ tên phải từ 5 - 50 ký tự!',
            'txt_ten_nguoi_lien_he.required' => 'Họ tên người liên hệ không được bỏ trống!',
            'txt_dien_thoai_nguoi_lien_he.required' => 'Số điện thoại không được bỏ trống!',
            'txt_dien_thoai_nguoi_lien_he.regex' =>'Số điện thoại không hợp lệ phải từ 10-15 ký tự!',

            'txt_dia_chi.required' => 'Địa chỉ không được bỏ trống!',
            'txt_dia_chi.regex' => 'Địa chỉ không hợp lệ, cần nhập từ 5 ký tự trở lên, không chứa ký tự đặc biệt. Có thể chứa dấu -,._',

//            'txt_email_nguoi_lien_he.required'=>'Email không được bỏ trống!',
            'txt_email_nguoi_lien_he.regex'=>'Email không hợp lệ',
//            'txt_email_nguoi_lien_he.unique' =>'Email đã tồn tại!',

            'txt_quy_mo.required'=>'Quy mô không được bỏ trống!',
            'txt_quy_mo.integer'=>'Quy mô không hợp lệ',
            'txt_linh_vuc.integer'=>'Lĩnh vực cần chọn trong danh sách',


            'txt_so_hoc_vien.required'=>'Số học viên không được bỏ trống!',
            'txt_so_hoc_vien.integer'=>'Số học viên không hợp lệ!',

            'txt_ten_doanh_nghiep.required'=>'Tên doanh nghiệp không được bỏ trống!',
            'txt_ten_doanh_nghiep.min'=>'Tên doanh nghiệp phải từ 3 ký tự trở lên',

        ];
    }
}