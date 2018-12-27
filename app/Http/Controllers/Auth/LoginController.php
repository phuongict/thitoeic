<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\MessageBag;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $v;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','getLogin']);
        $this->v['_title'] = 'Mộc Châu IT';
    }

    public function getLogin(){
        if(Auth::User() != null)
            return redirect()->intended('/');
        $this->v['_title'] = 'Đăng nhập';
        $this->v['_action'] = 'Login';
        return view('auth.login',$this->v);
    }
    public function postLogin(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' =>'required|min:6'
        ];
        $messages = [
            'email.required' => 'Email không được bỏ trống!',
            'email.email' => 'Email không hợp lệ!',
            'password.required' => 'Mật khẩu không được bỏ trống!',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự!',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else{
            $email = $request->input('email');
            $password = $request->input('password');
            if(Auth::attempt(['email'=>$email, 'password'=> $password])){
                return redirect()->intended('/');
            }
            else{
                $message = new MessageBag(['error_login'=>'Sai email hoặc mật khẩu!']);
                return redirect()->back()->withInput()->withErrors($message);
            }
        }
    }
    public function logout($errors_msg = null){
        if(Auth::user() != null){
            $params = [
                'user_id'=>Auth::user()->id,
                'action'=>'logout',
                'table'=>'tb_user',
                'detail'=>'IP: '. $_SERVER['REMOTE_ADDR'],
                'action_time'=>date('Y-m-d H:i:s'),
                'row_id' => 0
            ];
            $res = $this->saveActivity($params);
            if(!$res)
                return redirect()->back();
        }
        Auth::logout(); // log the user out of our application
        Session::flush();

        if($errors_msg != null)
            return redirect()->route('login')->withErrors($errors_msg);
        else
            return redirect()->route('login');
    }
}
