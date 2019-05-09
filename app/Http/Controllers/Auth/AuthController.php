<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function getSms()
    {
        return view("auth/sms");
    }

    public function postSms(Request $request)
    {
        if (!$request->input("phone"))
            return redirect("auth/sms")->withErrors("لطفا تلفن همراه را وارد نمایید.");
        if (strlen($request->input("phone")) != 11)
            return redirect("auth/sms")->withErrors("لطفا تلفن همراه را درست وارد نمایید.");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('CDN_AUTH_URL') . "/api/v1/auth/otp/sms",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"mobile\"\r\n\r\n09111160804\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Postman-Token: 5860049f-7bc0-4b90-a98f-69264d581c5e",
                "X-Debug: 1",
                "app: G-market",
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                "typeApp: justkish",
                "typeAppChild: justkish"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        if ($err)
            return redirect("auth/sms")->withErrors($err);
        if ($info['http_code'] != 200)
            return redirect("auth/sms")->withErrors(json_decode($response)->error);
        $data["phone"] = json_decode($response)->data->phone;
        return view("auth/verify", $data);
    }

    public function postVerify(Request $request)
    {
        if (!$request->input('code'))
            return redirect("auth/sms")->withErrors("لطفا کد خود را بررسی کنید");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('CDN_AUTH_URL') . "/api/v1/auth/otp/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "mobile=" . $request->input("phone") . "&code=" . $request->input("code"),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Postman-Token: 3d4c88f0-8b28-45a9-a198-d491062d6d3c",
                "agent: web",
                "app: G-market",
                "cache-control: no-cache",
                "typeApp: justkish",
                "typeAppChild: justkish"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        if ($err)
            return redirect("auth/sms")->withErrors($err);
        if ($info['http_code'] != 200)
            return redirect("auth/sms")->withErrors(json_decode($response)->error);
        $admin = User::where(['type_app_id' => json_decode($response)->data->user_apps->id, 'user_id' => json_decode($response)->data->id])->first();
        if (!$admin)
            return redirect("auth/sms")->withErrors("کاربر گرامی شما مدیر سیتم نیستید");
        Auth::login($admin);
        if (!json_decode($response)->data->user_apps->activated) {
            auth()->logout();
            return redirect('/auth/login')->with('warning', 'کاربر گرامی حساب شما غیر فعال شده است.');
        }
        return redirect('/');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/auth/sms');
    }

}


