<style>
    .fajr {
        width: 15px;
        height: 15px;
        margin: 0px 11px 0px -8px;
        background-size: cover;
    }

    .dhuhr {
        width: 15px;
        height: 15px;
        margin: 0px 11px 0px -10px;
        background-size: cover;
    }

    .asar {
        width: 15px;
        height: 15px;
        margin: 0px 11px 0px -6px;
        background-size: cover;
    }

    .magrib {
        width: 15px;
        height: 15px;
        margin: 0px 11px 0px -9px;
        background-size: cover;
    }

    .isha {
        width: 15px;
        height: 15px;
        margin: 0px 11px 0px -9px;
        background-size: cover;
    }

    .jummah {
        width: 15px;
        height: 15px;
        margin: 0px 11px 0px 0px;
        background-size: cover;
    }

    .salat {
        width: 25px;
        height: 30px;
        margin: 0px 11px 0px 0px;
        background-size: cover;
    }

    .azan {
        width: 25px;
        height: 30px;
        margin: 0px 11px 0px 0px;
        background-size: cover;
    }
</style>

<section class="" id="prayerTime" ng-controller="myCtrl"/>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h5 class="section-title">আপনার জেলা নির্বাচন করে সেহেরি ও ইফতারের সময় দেখুন</h5>
        </div>
        <div class="col-md-6">

            <select class="form-control" name="location" ng-model="location" ng-change="changeLocation(value)">
                <option value="">আপনার জেলা নির্বাচন করুন</option>
                <option value="8">ঠাকুরগাঁও, নবাবগঞ্জ</option>
                <option value="7">দিনাজপুর , পঞ্চগড়</option>
                <option value="6">রাজশাহী,মেহেরপুর,জয়পুরহাট,সাতক্ষীরা</option>
                <option value="5">নাটোর,নীলফামারী</option>
                <option value="4">লালমনিরহাট,বগুড়া,যশোর,কুষ্টিয়া, ঝিনাইদহ,পাবনা,রংপুর</option>
                <option value="3">খুলনা,গাইবান্ধা,সিরাজগঞ্জ</option>
                <option value="2">ফরিদপুর,বাগেরহাট,জামালপুর</option>
                <option value="1">মাদারীপুর,বরিশাল,ঝালকাটি,পটুয়াখালী</option>
                <option value="-6">বান্দরবান,রাঙামাটি</option>
                <option value="-5">সিলেট,চট্টগ্রাম</option>
                <option value="-4">সুনামগঞ্জ ,হবিগঞ্জ,ফেনী</option>
                <option value="-3">কুমিল্লা ,ব্রাম্মণবাড়িয়া ,নোয়াখালী</option>
                <option value="-2">ময়মনসিংহ ,কিশোরগঞ্জ</option>
                <option value="-1">নরসিংদী ,মুন্সীগঞ্জ,চাঁদপুর,টাঙ্গাইল</option>

            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="section-title">আজানের দোয়া</h5>
                            <p>আল্লাহুম্মা রব্বা হাজিহিদ দাওয়াতিত তাম্মাতি ওয়াস সালাতিল কায়িমাতি আতি মুহাম্মাদানিল
                                ওয়াসিলাতা ওয়াল ফাদিলাতা ওয়াদ দারজাতার রফিআতা ওয়াবআসহু মাকামাম মাহমুদানিল্লাজি
                                ওয়াআত্তাহু; ওয়ারজুকনা শাফাআতাহু ইয়াওমাল কিয়ামাতি, ইন্নাকা লা তুখলিফুল মিআদ।</p>

                            <p><b>এই দোয়ার অর্থ:</b> হে আল্লাহ! এই পরিপূর্ণ আহ্বানের ও স্থায়ী প্রতিষ্ঠিত নামাজের আপনিই প্রভু।
                                হজরত মুহাম্মদ (সা.)-কে ওয়াসিলা ও সুমহান মর্যাদা দান করুন এবং তাঁকে ওই প্রশংসিত স্থানে
                                অধিষ্ঠিত করুন, যার প্রতিশ্রুতি আপনি তাঁকে দিয়েছেন আর কিয়ামতের দিন তাঁর সুপারিশ আমাদের
                                নসিব করুন; নিশ্চয়ই আপনি প্রতিশ্রুতির ব্যতিক্রম করেন না। আজানের পর দরুদ শরিফ পড়ে এ দোয়া
                                পড়া সুন্নত।</p>
                        </div>
                        <div class="col-md-6">

                            <table class="table table-bordered table-hover" ng-init="changeLocation(0)">
                                <thead>
                                <tr>
                                    <th><img class="azan" src="/icons/salat-name.png"/>সালাত</th>
                                    <th><img class="salat" src="/icons/salat-time.png"/>সময়</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img class="fajr" src="/icons/1.png"/>ফজর</td>
                                    {{--<td>{{$data_array['fajr']}}</td>--}}
                                    <td><span ng-bind="fajr"></span></td>
                                </tr>
                                <tr>
                                    <td><img class="dhuhr" src="/icons/22.png"/>জোহর</td>
                                    {{-- <td>{{$data_array['fajr']}}</td>--}}
                                    <td><span ng-bind="dhuhr"></span></td>
                                </tr>
                                <tr>
                                    <td><img class="asar" src="/icons/33.png"/>আসর</td>
                                    {{--<td>{{$data_array['fajr']}}</td>--}}
                                    <td><span ng-bind="asr"></span></td>
                                </tr>
                                <tr>
                                    <td><img class="magrib" src="/icons/55.png"/>মাগরিব</td>
                                    {{--<td>{{$data_array['fajr']}}</td>--}}
                                    <td><span ng-bind="maghrib"></span></td>
                                </tr>
                                <tr>
                                    <td><img img class="isha" src="/icons/77.png"/>এশা</td>
                                    {{-- <td>{{$data_array['fajr']}}</td>--}}
                                    <td><span ng-bind="isha"></span></td>
                                </tr>
                                {{-- <tr>
                                     <td><img class="fajr" src="/icons/1.png"/>জোহর </td>
                                     <td>01.30 pm</td>
                                 </tr>
                                 <tr>
                                     <td><img class="fajr" src="/icons/1.png"/>Asar</td>
                                     <td>05.10 pm</td>
                                 </tr>
                                 <tr>
                                     <td><img class="fajr" src="/icons/1.png"/>Magrib</td>
                                     <td>06.50 pm</td>
                                 </tr>
                                 <tr>
                                     <td><img class="fajr" src="/icons/1.png"/>Isha</td>
                                     <td>08.30 pm</td>
                                 </tr>
                                 <tr>
                                     <td><img class="fajr" src="/icons/1.png"/> Jumah</td>
                                     <td>12.30 pm</td>
                                 </tr>--}}
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


</div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    var app = angular.module('myApp', []);


    app.controller('myCtrl', function ($scope, $http) {

        console.log("hello")

        $scope.changeLocation = function () {
            console.log($scope.location)
            $http({
                method: 'GET',
                url: '/get-prayer-time/' + $scope.location
            }).then(function successCallback(response) {
                console.log(response.data)
                $scope.fajr = response.data['fajr'];
                $scope.dhuhr = response.data['dhuhr'];
                $scope.asr = response.data['asr'];
                $scope.maghrib = response.data['maghrib'];
                $scope.isha = response.data['isha'];


            }, function errorCallback(response) {
                console.log(response)
            });
        }
    });
</script>
