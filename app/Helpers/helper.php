<?php

use App\Models\EntrepreneurApply;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

function getDegreeType()
{
    return [
        "1" => 'Undergraduate',
        "2" => 'Graduate',
        "3" => 'Post Graduate',
    ];
}

function getDegreeName($id)
{
    return getDegreeType()[$id];
}

function schoolType()
{
    return [
        "1" => 'School of Business & Economics',
        "2" => 'School of Business & Economics',
        "3" => 'School of Humanities & Social Sciences',
        "4" => 'School of Health & Life Sciences',
        "5" => 'Other',
    ];
}

function getSchoolName($id)
{
    return getDegreeType()[$id];
}

function getMembershipType()
{
    return [
        "1" => 'Gold',
        "2" => 'Regular',
    ];
}

function getAgeType()
{
    return [
        "1" => '১৫-২০',
        "2" => '২১-৩০',
        "3" => '৩১-৪০',
        "4" => '৪০+',
    ];
}
function getBrandUseType()
{
    return [
        "1" => 'সুপার হোয়াইট',
        "2" => 'চাকা অ্যাডভান্স',
        "3" => 'হুইল',
        "4" => 'রিন',
        "5" => 'জেট ',
        "6" => 'ফাস্ট ওয়াশ ',
        "7" => 'সার্ফ এক্সেল ',
        "8" => 'অন্যান্য',
    ];
}


function getErrorMessage($error)
{
    return $error;
    return "There is an Error";
}

function getYoutubeVideoLink($link)
{
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $matches);
    if ($matches != null) {
        $video = "https://www.youtube.com/embed/" . $matches[0];
    } else {
        $video = "";
    }

    return $video;
}

function getFbLink($link)
{

    $str = $link;
    if (str_contains($str, "posts",)) {

        $del = "posts";
    } else {

        $del = "video";
    }

    $pos = strpos($str, $del);
    $important = substr($str, $pos + strlen($del) - 1, strlen($str) - 1);
    if (preg_match("~(?:t\.\d+/)?(\d+)~i", $important, $matches)) {
        $links = $matches[1];
    } else {
        $links = "";
    }

    return $links;
}

function getKyeFbLink($link)
{
    if (preg_match_all("!\d+!", $link, $matches)) {
        $link = $matches[0];

        $lastKey = end($link);

        // $lastKey = substr($matches, -1) ;
    } else {
        $lastKey = "";
    }
    return $lastKey;


}

function getYoutubeVideoId($link)
{
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $matches);
    if ($matches != null) {
        $video = $matches[0];
    } else {
        $video = "";
    }

    return $video;
}

function getTextToUrl($link)
{
    $link = preg_replace('/\s+/', '-', $link);
    return $link;
}

function getUniversityNameFromId($id)
{

    $is_exist = \App\Models\Institute::where('id', $id)->first();
    if (is_null($is_exist)) {
        return " N/A";
    }
    return $is_exist->institute_name;
}

function getInstituteIdFromCourse($id)
{
    $is_exist = \App\Models\Course::where('id', $id)->first();
    if (is_null($is_exist)) {
        return 1;
    }
    return $is_exist->institute_id;
}

function getApiKey()
{
    return "62847a72-396f-4472-aa5f-e7ba7a5252eb";
}

function getDistrict()
{
    return \Devfaysal\BangladeshGeocode\Models\District::all();
}

function getDistrictName($id)
{
    return \Devfaysal\BangladeshGeocode\Models\District::where('id', $id)->first()->name;
}

function getUpzilaName($id)
{
    return \Devfaysal\BangladeshGeocode\Models\Upazila::where('id', $id)->first()->name;
}

function getSubjectNameFromId($id)
{
    $is_exist = \App\Models\Subject::where('id', $id)->first();
    if (is_null($is_exist))
        return "-";
    return $is_exist->subject_name;
}

function getUniversityEmail($id)
{
    $is_exist = \App\Models\Institute::where('id', $id)->first();
    if (is_null($is_exist))
        return "";
    return $is_exist->email;
}

function getUniversityName($id)
{
    $is_exist = \App\Models\Institute::where('id', $id)->first();
    if (is_null($is_exist))
        return "";
    return $is_exist->institute_name;
}

function getApplicationStatus()
{
    $application_update_status = 0;
    if (Auth::guard('applicant')->check()) {
        $is_exist = EntrepreneurApply::where('phone_number', Auth::guard('applicant')->user()->phone)
            ->where('is_complete', false)
            ->first();
        if (!is_null($is_exist)) {
            $application_update_status = 1;
        }
    }

    return $application_update_status;
}

function getDateFormat($data)
{

    return $date2 = Carbon::parse($data)->format('d F y');
}

function validatePhoneNumber($phone)
{

    if ($phone == null) {
        return 0;
    }
    if (substr($phone, 0, 1) != '0') {
        $phone = "0" . $phone;
    }

    $pattern = "/^(?:\+88|01)?(?:\d{11}|\d{13})$/";
    if (preg_match($pattern, $phone)) {
        return 1;
    };
}
