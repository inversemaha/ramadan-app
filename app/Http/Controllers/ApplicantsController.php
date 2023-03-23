<?php

namespace App\Http\Controllers;

use App\Models\Applicants;
use App\Models\EntrepreneurApply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApplicantsController extends Controller
{

    public function login()
    {
        return view("common.applicant.login");
    }

    public function create()
    {
        return view("common.applicant.create");
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $old_password = $request['password'];
        $request['password'] = Hash::make($request['password']);
        //return $request->all();
        try {
            Applicants::create($request->except(['_token']));

            $credentials = [
                'email' => $request['email'],
                'password' => $old_password,
            ];
            if (Auth::guard('applicant')->attempt($credentials)) {

                return Redirect::to("/apply");
            }

            return back()->with("success", "Successfully Account Created. Login to Continue");

        } catch (\Exception $exception) {
            return back()->with("failed", $exception->getMessage());
            return back()->with("failed", "There is a problem Try Later");
        }
    }

    public function loginDo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        if (Auth::guard('applicant')->attempt($credentials)) {

            return Redirect::to("/apply");
        }
        return back()->with("failed", "Email or Password is wrong!");
    }

    public function forgetPassword()
    {
        return view("common.applicant.forget_password");
    }

    public function sentPassword(Request $request)
    {
        $password = rand(1000, 100000);
        $is_exist = Applicants::where('phone', $request['phone'])->where('email', $request['email'])->first();
        if (is_null($is_exist)) {
            return back()->with("failed", "আপনি ভুল ইমেল এড্রেস অথবা ফোন নাম্বার দিয়েছেন| অনুগ্রহ করে এডমিনের সাথে যোগাযোগ করুন");
        }
        Applicants::where('phone', $request['phone'])->update([
            'password' => Hash::make($password)
        ]);
        $msg = "নতুন পাসওয়ার্ড: " . $password . " . লগইন করতে এখানে যান -  https::www.smeaward.com/applicant/login";
        mail($request['email'], "Password Reset", $msg);
        return back()->with("success", "আপনার নতুন পাসওয়ার্ড ইমেইলে পাঠানো হয়েছে।  ইনবক্সে না পেলে স্প্যাম ফোল্ডার চেক করুন। ");

    }

    public function applicantApplication()
    {
        $is_exist = EntrepreneurApply::where('phone_number', Auth::guard('applicant')->user()->phone)
            ->get();
        return view("common.applicant.application")->with('is_exist', $is_exist);
    }

    public function logout()
    {
        Auth::guard('applicant')->logout();
        return Redirect::to("/applicant/login");
    }

    public function destroy($id)
    {

        try {
            Applicants::where('id', $id)->delete();
            return back()->with("success", "Successfully Deleted");
        } catch (\Exception $exception) {

            return back()->with("failed", $exception->getMessage());

        }

    }

    public function active($id)
    {
        try {
            Applicants::where('id', $id)->update([
                'is_active' => true
            ]);
            return back()->with('success', "Successfully Active");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }

    public function inactive($id)
    {
        try {

            Applicants::where('id', $id)->update([
                'is_active' => false
            ]);
            return back()->with('success', "Successfully inactive");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }

    public function winnerStatusUpdate($id, $status)
    {

        Applicants::where('id', $id)->update([
            'is_short_listed' => $status
        ]);

        return back()->with("success", "Updated");

    }
  public function edit($id)
    {


           $result= Applicants::where('id', $id)->first();
            return view('admin.status.edit')->with('result', $result);


    }

    public function update(Request $request)
    {

        if (str_contains($request['fb_link'], "iframe",)) {

            $flink = $request['fb_link'];
        } else {

            $flink = getFbLink($request['fb_link']);
        }


        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'fb_link' => $flink,
            'status' => $request['status'],

        ];


        try {
            Applicants::where('id', $request['id'])->update($data);
            return back()->with('success', "Successfully Updated");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());


        }

    }


}
