<?php

namespace App\Http\Controllers;

use App\Models\Applicants;
use App\Models\McqQuiz;
use App\Models\McqQuizSubmission;
use App\Models\SelfieSubmission;
use App\Models\SelfieVote;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test(Request $request)
    {
        if ($request->isMethod("POST")) {
            return $request->all();
        }

        return view('common.home.test');
    }

    public function home()
    {
        /*if (Carbon::now() > "2021-12-16 23:59:59") {
            return Redirect::to("/campaign-over");
        }*/
        //  return District::all();

        $news = Applicants::where('is_active', true)->orderby("created_at", "DESC")->paginate(10);
        /*$winners = Applicants::where('is_short_listed', true)->orderBy('created_at', 'DESC')->get();*/

        /* foreach ($winners as $item) {
             $count = SelfieVote::where('selfie_id', $item->id)->count();
             $item->vote_count = $count;
         }*/


        // return view('test');

        //Read json file from public folder
        $json = file_get_contents(public_path('json/prayer-time.json'));
        //Decode json data
        $data = json_decode($json, true);

        $currentDate = date('Y-m-d');

        foreach ($data as $item) {
            if ($item['date'] == $currentDate) {
                // Found the data for current date
                $sehri = $item['sehri'];
                $fajr = $item['fajr'];
                $dhuhr = $item['dhuhr'];
                $asr = $item['asr'];
                $maghrib = $item['maghrib'];
                $isha = $item['isha'];
                $sunrise = $item['sunrise'];
                break;
            }
        }


        $time = '2023-03-24T04:39';
        $carbon = new Carbon($time);
        $newTime = $carbon->addMinutes(5)->format('Y-m-d\TH:i');
        return $newTime; // Output: 2023-03-24T04:44



        return response()->json([
            'sehri' =>  $this->convertNumberToBangla(date('H:i', strtotime($sehri))),
            'fajr' =>  $this->convertNumberToBangla(date('H:i', strtotime($fajr))),
            'dhuhr' =>  $this->convertNumberToBangla(date('H:i', strtotime($dhuhr))),
            'asr' =>  $this->convertNumberToBangla(date('H:i', strtotime($asr))),
            'maghrib' =>  $this->convertNumberToBangla(date('H:i', strtotime($maghrib))),
            'isha' =>  $this->convertNumberToBangla(date('H:i', strtotime($isha))),
            'sunrise' =>  $this->convertNumberToBangla(date('H:i', strtotime($sunrise))),
        ]);


        return view('common.home.index')
            // ->with('news', $news)
            ->with('news', $news)
            ->with("thumbnail", "/images/facebook.png")
            ->with("fb_title", "তীর রমজানুল মোবারক ")
            ->with("fb_sub_title", "তীর এর পক্ষ থেকে সবাইকে রমজানুল মোবারক এর শুভেচ্ছা");


        // $videos = Video::get();
        return $news = Applicants::where('is_active', true)->get();
        // $photos = Photos::where('is_featured', 1)->get();
        return view('common.home.index')
            ->with('videos', $videos)
            ->with('news', $news)
            ->with('photos', $photos);
    }

    function convertNumberToBangla($number)
    {
        $banglaNumbers = array(
            '০',
            '১',
            '২',
            '৩',
            '৪',
            '৫',
            '৬',
            '৭',
            '৮',
            '৯'
        );

        $banglaNumber = "";
        $numberLength = strlen($number);

        for($i = 0; $i < $numberLength; $i++) {
            $char = substr($number, $i, 1);

            if($char == ':') {
                $banglaNumber .= ':';
            } else {
                $digit = intval($char);
                $banglaNumber .= $banglaNumbers[$digit];
            }
        }

        return $banglaNumber;

    }

    public function applicantSubmit(Request $request)
    {
        // return $request->all();
        /*   if (Carbon::now() > "2022-03-08 23:59:59") {
               Session::flash('error', 'campaign-over');
               return back();
           }*/

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'district' => 'required',
            'fb_id_link' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'brand_use' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors());
            return back()->withInput();

        }
        if ($request->flexRadioDefault == 1) {
            $validator = Validator::make($request->all(), [
                'fb_link' => 'required',
            ]);
            if ($validator->fails()) {
                Session::flash('error', 'ফেসবুক পোস্ট লিংক পূরণ করুন।');
                return back()->withInput();

            }
        }
        if ($request->brand_use == "অন্যান্য") {
            $validator = Validator::make($request->all(), [
                'onnano_brnad' => 'required',
            ]);
            if ($validator->fails()) {
                Session::flash('error', 'আপনার ব্যবহৃত ব্রান্ডের নাম পূরণ করুন।');
                return back()->withInput();

            }
        }
        if ($request->flexRadioDefault == 2) {
            $validator1 = Validator::make($request->all(), [
                'status' => 'required',
            ]);
            $validator2 = Validator::make($request->all(), [
                'images' => 'required',
            ]);
            if ($validator1->fails()) {
                Session::flash('error', 'আপ্যায়ন মুহূর্তের অনুভূতির কথা পূরণ করুন। ');
                return back()->withInput();

            }
            if ($validator2->fails()) {
                Session::flash('error', 'কমপক্ষে ১ টি এবং সর্বোচ্চ ৩ টি  ছবি আপলোড করুন।');
                return back()->withInput();

            }
        }


        $files = null;

        if ($request->hasfile('images')) {
            $i = 1;

            foreach ($request->file('images') as $image) {
                /* $name=$image->getClientOriginalName();
                 $img = Image::make($image->getRealPath());
                 $img->resize(300, 300, function ($constraint) {
                     $constraint->aspectRatio();
                 });

                 $img->save(public_path().'/images/applicant', $name);
                 $data[] = $name;*/

                $name = time() . $i . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('/images/applicant');
                $imgFile = Image::make($image->getRealPath());
                $imgFile->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $name);
                $destinationPath = public_path('/uploads');
                $image->move($destinationPath, $name);
                $data[] = $name;

                $i++;
            }
            $files = $request->multi_images = json_encode($data);
        }


        /*   if(\Carbon\Carbon::now() > "2022-02-22 23:59:59") {
            Session::flash('error', ' @if(\Carbon\Carbon::now() > "2022-02-22 23:59:59")।');
            return back();

        }*/

        $request['fb_user_input'] = $request['fb_link'];

        if (str_contains($request['fb_link'], "iframe",)) {

            $flink = $request['fb_link'];
        } else {

            $flink = getFbLink($request['fb_link']);
        }


        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'fb_link' => $flink,
            'fb_user_input' => $request['fb_user_input'],
            'status' => $request['status'],
            'district' => $request['district'],
            'fb_id_link' => $request['fb_id_link'],
            'age' => $request['age'],
            'gender' => $request['gender'],
            'brand_use' => $request['brand_use'],
            'onnano_brnad' => $request['onnano_brnad'],
            'multi_images' => $files,

        ];


        try {
            Applicants::create($data);
            //return Applicants::orderBy('created_at', "DESC")->first();
            Session::flash('message', 'আপনার সাদা কাপড়ের সুপার হিরো এর গল্পটি আমাদের সাথে শেয়ার করার জন্য ধন্যবাদ।');
            return back();
        } catch (\Exception $exception) {

            Session::flash('error', $exception->getMessage());

            return back()->with();
        }

    }

    public function selfieContest()
    {
        $data = SelfieSubmission::where('is_publish', true)
            ->orderBy('created_at', 'DESC')
            ->paginate(8);
        foreach ($data as $item) {
            $count = SelfieVote::where('selfie_id', $item->id)->count();
            $item->vote_count = $count;
        }

        return view('common.home.selfie-contest')
            ->with('data', $data)
            ->with("thumbnail", "/images/selfie.jpg")
            ->with("fb_title", "ভিশন এন্ড্রোয়েড টিভি সেলফি কনটেস্টে")
            ->with("fb_sub_title", "ভিশন এন্ড্রোয়েড টিভি সেলফি কনটেস্টে অংশ নিন পুরস্কার জিতুন ");
    }

    protected function selfieContestVote(Request $request)
    {
        //return $request->ip();

        $phone = $request['phone'];

        $is_validated = validatePhoneNumber($phone);
        if (!$is_validated) {
            Session::flash('error', 'ফোন  নাম্বারটি সঠিক নয়।');
            return back();
        }
        $is_exist = SelfieVote::where('phone', $phone)->where('selfie_id', $request['id'])->first();
        $is_ip = SelfieVote::where('ip_address', $request->ip())->where('selfie_id', $request['id'])->first();
        if ($is_ip != null) {
            Session::flash('error', 'আপনি আগেই ভোট দিয়েছেন ');

            return back();

        }
        if (is_null($is_exist)) {

            SelfieVote::create([
                'phone' => $request['phone'],
                'selfie_id' => $request['id'],
                'ip_address' => $request->ip(),
            ]);

            Session::flash('message', 'আপনার ভোটটি গ্রহণ করা হল। ');

        }
        Session::flash('error', 'আপনি আগেই ভোট দিয়েছেন ');

        return back();
        /*SelfieVote::create([
            ''
        ])*/


    }

    public function selfieContestSubmit(Request $request)
    {
        $is_submitted = SelfieSubmission::where('phone', $request['phone'])
            ->whereDate('created_at', Carbon::today())
            ->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'selfie' => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'ফর্মের তথ্যগুলি ঠিকমত পূরণ করে সাবমিট করুন।');
            return back();

        }

        if (!is_null($is_submitted)) {
            Session::flash('error', 'আপনার উত্তর আগেই গ্রহণ করা করা হয়েছে।');
            return back();
        }
        if ($request->hasFile('selfie')) {
            $image = $request->file('selfie');
            $image_name = "selfie_" . time() . rand(5, 55555) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/selfie');
            $image->move($destinationPath, $image_name);
            $request['image'] = '/images/selfie/' . $image_name;
        }
        $request['district'] = getDistrictName($request['district']);
        $request['upazila'] = getUpzilaName($request['upazila']);

        //return $request->all();
        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'selfie' => $request['image'],
            'district' => $request['district'],
            'upazila' => $request['upazila'],
        ];

        try {
            SelfieSubmission::create($data);
            Session::flash('message', 'আপনার সেলফি গ্রহণ করা হয়েছে। ');
            return back();
        } catch (\Exception $exception) {
            return back();
        }

        return back();

    }

    public function photoContest()
    {
        $data = McqQuiz::orderBy('created_at', 'desc')
            ->where('is_publish', true)
            ->first();

        return view('common.home.photo-contest')
            ->with("data", $data)
            ->with("thumbnail", "/images/picture.jpg")
            ->with("fb_title", "প্রাণ সস পিকচার কুইজ")
            ->with("fb_sub_title", "প্রাণ সস পিকচার কুইজ খেলুন পুরস্কার জিতুন।");
    }

    public function photoContestSubmit(Request $request)
    {

        $is_submitted = McqQuizSubmission::where('phone', $request['phone'])
            ->whereDate('created_at', Carbon::today())
            ->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'question_id' => 'required',
            'answer' => 'required',
            'district' => 'required',
            'upazila' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'ফর্মের তথ্যগুলি ঠিকমত পূরণ করে সাবমিট করুন।');
            return back();

        }


        if (!is_null($is_submitted)) {
            Session::flash('error', 'আপনার উত্তর আগেই গ্রহণ করা করা হয়েছে।');
            return back();
        }
        $request['district'] = getDistrictName($request['district']);
        $request['upazila'] = getUpzilaName($request['upazila']);
        $question = McqQuiz::where('id', $request['question_id'])->first();

        $is_right = false;
        if ($question->right_answer == $request['answer']) {
            $is_right = true;
        }

        $array = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'question_id' => $request['question_id'],
            'answer' => $request['answer'],
            'district' => $request['district'],
            'upazila' => $request['upazila'],
            'is_right_ans' => $is_right,
        ];

        try {
            McqQuizSubmission::create($array);
            Session::flash('message', 'আপনার উত্তর গ্রহণ করা হয়েছে।');
            return back();
        } catch (\Exception $exception) {
            // return $exception->getMessage();

            return back();
        }

    }


    public function over()
    {
        return view('common.home.over');
    }

    public function photoUpload(Request $request)
    {
        if (Carbon::now() > "2021-12-16 23:59:59") {
            return Redirect::to("/campaign-over");
        }

        //return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => ['Required'],
            'guardian_phone' => ['Required'],
            'class_group' => ['Required'],
            'drawing' => ['Required'/*, 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'*/]
        ]);

        if ($validator->fails()) {
            Session::flash('title', 'ফর্মের তথ্যে ভুল আছে।');
            Session::flash('error', 'ফর্মের সকল তথ্য সঠিকভাবে পূরণ করে আবার চেষ্টা করো।');
            return back()->withInput();
        }

        if ($request->hasFile('drawing')) {
            $image = $request->file('drawing');
            $image_name = "drawing_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/drawing');
            $image->move($destinationPath, $image_name);
            $request['image'] = '/images/drawing/' . $image_name;
        }

        //return $request->all();
        $data = [
            'name' => $request['name'],
            'guardian_phone' => $request['guardian_phone'],
            'address' => $request['address'],
            'class_group' => $request['class_group'],
            'drawing' => $request['image'],
        ];


        $is_exist = Applicants::where('guardian_phone', $request['guardian_phone'])->first();
        if (!is_null($is_exist)) {
            Session::flash('title', 'সাবমিশন আগেই গ্রহণ করা হয়েছে।');
            Session::flash('error', 'এই ফোন নম্বর দিয়ে আগেই ড্রইং সাবমিট করা হয়েছে।');
            return back()->withInput();
        }

        try {
            Applicants::create($data);

            Session::flash('success', 'তোমার সাবমিশন গ্রহণ করা হয়েছে।');

            return back();
        } catch (\Exception $exception) {
            return back();
            return $exception->getMessage();
        }

        Session::flash('title', 'ফর্মের তথ্যে ভুল আছে।');
        Session::flash('error', 'ফর্মের সকল তথ্য সঠিকভাবে পূরণ করে আবার চেষ্টা করো।');
        return back()->withInput();

    }


    public function error(Request $request)
    {
        return view('common.error.404');
    }

    public function success(Request $request)
    {
        return view('common.error.success');
    }

    public function fair()
    {
        return view('common.fair.index2');
    }

    public function contact()
    {
        return view('common.contact.index');
    }

    public function testg()
    {
        /* foreach (getDegreeType() as $key => $lll) {
             echo $key;
         }

         return;*/

        return getTextToUrl("DAFFODIL INTERNATIONAL UNIVERSITY");
        return view('common.home.test');
    }

    public function getData()
    {

        /* $data= DB::table('entrepreneur_applies')->get();
         return json_decode($data[0]->business_documents)[0];
         return view('common.home.test');*/
    }

    public function getUpzila($id)
    {

        return Upazila::where('district_id', $id)->get();

    }


}
