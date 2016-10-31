<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Models\ProductCart;
use App\Models\WebUser;
use Illuminate\Http\Request;

class UserWebController extends Controller
{
    public function signUp(Request $request)
    {
        $inputs = $request->all();
        $inputs['password'] = hash('sha256', $inputs['password']);
        $inputs['remember_token'] = bcrypt($inputs['password'] . '' . $inputs['email']);
        $create = WebUser::create($inputs);
        if ($create) {
            return back()->with('success', 'สมัครสมาชิกสำเร็จ');
        } else {
            return back()->with('failed', 'สมัครสมาชิกไม่สำเร็จ');
        }
    }

    public function signIn(Request $request)
    {
        $inputs = $request->all();
        $password = hash('sha256', $inputs['password']);

        $validation_user = WebUser::select('remember_token')->where('email', $inputs['email'])->where('password', $password)->first();

        if ($validation_user) {
            $request->session()->put('remember_token', $validation_user->remember_token);
            return back()->with('success', 'เข้าสู่ระบบสำเร็จ');
        } else {
            return back()->with('failed', 'เข้าสู่ระบบไม่สำเร็จ');
        }
    }

    public function signOut(Request $request)
    {
        $request->session()->flush();
        return redirect('')->with('success', 'ออกจากระบบสำเร็จ');
    }

    public function getUserInformation(Request $request)
    {
        $user_id = userId($request);

        $user = WebUser::find($user_id);

        return view('web.user', compact('user'));
    }

    public function updateUserInformation(Request $request)
    {
        $input = $request->all();
        $user_id = userId($request);

        WebUser::find($user_id)->update($input);

        return back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }


}
