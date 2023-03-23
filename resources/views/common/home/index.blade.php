@extends('layouts.common')

@section('content')

    @include('common.home.slider')
    @include('common.home.prayer-time')

    <section class="" id="ad">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div id="iftar">
                        <h5 class="section-title">ইফতারের সময় বাকি </h5>
                        <p>এই সময়সূচি ঢাকা অঞ্চলের জন্য প্রযোজ্য
                            ( @if(\Illuminate\Support\Carbon::now()->format('F') == "April")
                                এপ্রিল @else মে @endif <span class="bangla-font"
                                                             id="ifter_date">-</span>) </p>

                        <ul class="list-inline">

                            <li class="list-inline-item">
                                <div class="hour">
                                    <h4>ঘন্টা<br> <span id="hour">-</span></h4>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="min">
                                    <h4> মিনিট <br> <span id="min">-</span></h4>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="sec">
                                    <h4> সেকেন্ড <br> <span id="sec">-</span></h4>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <div>
                        <h5 class="section-title">সেহরির শেষ সময়</h5>
                        <p>এই সময়সূচি ঢাকা অঞ্চলের জন্য প্রযোজ্য
                            (@if(\Illuminate\Support\Carbon::now()->format('F') == "April")
                                এপ্রিল @else মে @endif <span class="bangla-font"
                                                             id="seheri_date">-</span>) </p>

                        <center>
                            <div id="seheri">
                                <h3 class="bangla-font"><span id="seheri_time">-</span></h3>
                            </div>
                        </center>


                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="section-title">আপনার জেলা নির্বাচন করে সেহেরি ও ইফতারের সময় দেখুন</h5>
                            <select class="form-control" name="minute" onchange="addMinute(value)">
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
                        <div class="col-md-12 zila-time" id="zila">
                            <h5 class="section-title">ইফতারের সময়</h5>
                            <center>
                                <ul class="list-inline">

                                    <li class="list-inline-item">
                                        <div class="hour">
                                            <h4>ঘন্টা<br> <span id="zhour">-</span></h4>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="min">
                                            <h4> মিনিট <br> <span id="zmin">-</span></h4>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="sec">
                                            <h4> সেকেন্ড <br> <span id="zsec">-</span></h4>
                                        </div>
                                    </li>

                                </ul>

                                <div id="zila_seheri">
                                    <h5 class="section-title">সেহরির শেষ সময়</h5>
                                    <center>
                                        <div id="seheri">
                                            <h3 class="bangla-font"><span id="zila_seheri_time">-</span></h3>
                                        </div>
                                    </center>


                                </div>
                            </center>


                        </div>

                    </div>


                </div>
                {{--<div class="col-md-6 col-12">
                    <center>
                        <img src="/images/ifter_time.jpg"  alt="banner">

                    </center>
                </div>
                <div class="col-md-6 col-12">
                    <img src="/images/ifter_time.jpg"  alt="banner">

                </div>--}}
            </div>


        </div>
    </section>
    <section class="" id="roja">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">

                    <h5 class="section-title">যে সকল দিনে রোযা রাখা নিষিদ্ধ</h5>
                </div>
                <div class="col-md-4 nishiddo">
                    <div class="elementor-widget-container">
                        <div class="single-intro-text mb-5">
                            <i class="icon dripicons-time-reverse"></i>
                            <h3 class="ts-title">ঈদুল ফিতর (রামাযানের ঈদ) এর দিন।</h3>
                            <span class="count-number"></span>
                        </div><!-- single intro text end-->

                    </div>
                </div>
                <div class="col-md-4 nishiddo">
                    <div class="elementor-widget-container">
                        <div class="single-intro-text mb-5">
                            <i class="icon dripicons-time-reverse"></i>
                            <h3 class="ts-title">ঈদুল আযহা (কুরবানী) এর দিন। </h3>
                            <span class="count-number"></span>
                        </div><!-- single intro text end-->

                    </div>
                </div>
                <div class="col-md-4 nishiddo">
                    <div class="elementor-widget-container">
                        <div class="single-intro-text mb-5">
                            <i class="icon dripicons-time-reverse"></i>
                            <h3 class="ts-title"> ঈদুল আযহার এর পরে আরো তিন দিন।</h3>
                            <span class="count-number"></span>
                        </div><!-- single intro text end-->

                    </div>
                </div>
            </div>
        </div>
    </section>





    <script type="text/javascript">
        document.getElementById('zila').style.display = 'none';
        document.getElementById('zila_seheri').style.display = 'none';


        function addMinxute(minute) {
            document.getElementById('zila').style.display = 'block';
            document.getElementById('zila_seheri').style.display = 'block';

            console.log(minute)
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Typical action to be performed when the document is ready:
                    var response = xhttp.responseText;
                    let my_data = JSON.parse(response);
                    //today_iftar="April 04, 2022 21:50";
                    var new_time = moment(today_iftar).add(minute, 'minutes').format('MMMM DD, YYYY H:mm');
                    console.log(new_time);
                    var seheri_time = moment("April 04, 2022 " + my_data.sehri_time).add(minute, 'minutes').format('H:mm');
                    console.log(my_data.sehri_time + "yyyyyyyyyyyy");

                    setjelaIftarTime(new_time);
                    document.getElementById('zila_seheri_time').innerHTML = seheri_time;
                    console.log(seheri_time);


                }
            };
            xhttp.open("GET", "https://kitefest.qubitsolutionlab.com/api/v1/get-ramadan-time", true);

            xhttp.send();
        }

        function setIftarTime(mDate) {

            console.log("Regular: " + mDate);
            // Set the date we're counting down to
            var countDownDate = new Date(mDate).getTime();

// Update the count down every 1 second
            var x = setInterval(function () {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);


                document.getElementById('hour').innerHTML = hours;
                document.getElementById('min').innerHTML = minutes;
                document.getElementById('sec').innerHTML = seconds;
                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);

                    document.getElementById('hour').innerHTML = "0";
                    document.getElementById('min').innerHTML = "0";
                    document.getElementById('sec').innerHTML = "0";
                }
            }, 1000);
        }

        var is_started = 0;

        function setjelaIftarTime(mDate) {


            is_started++;
            console.log("jela: " + mDate);
            // Set the date we're counting down to
            var countDownDate = new Date(mDate).getTime();

// Update the count down every 1 second
            var x = setInterval(function () {

                console.log("started: " + is_started);
                if (is_started > 1) {
                    clearInterval(x);
                    is_started = 1;
                }
                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);


                document.getElementById('zhour').innerHTML = hours;
                document.getElementById('zmin').innerHTML = minutes;
                document.getElementById('zsec').innerHTML = seconds;
                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById('zhour').innerHTML = "0";
                    document.getElementById('zmin').innerHTML = "0";
                    document.getElementById('zsec').innerHTML = "0";

                }
            }, 1000);
        }

        function setSehriTime(sehri_time) {
            const myArray = sehri_time.split(":");
            document.getElementById('shour').innerHTML = myArray[0];
            document.getElementById('smin').innerHTML = myArray[1];
        }

        function check() {
            var now = moment();
            var hourToCheck = (now.day() !== 0) ? 17 : 15;
            var dateToCheck = now.hour(hourToCheck).minute(30);
            return moment().isAfter(dateToCheck);
        }


        function UserAction() {

            console.log("user action")
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Typical action to be performed when the document is ready:
                    var response = xhttp.responseText;
                    let my_data = JSON.parse(response);
                    console.log(my_data);
                    // document.getElementById('title').innerHTML = matchTimeLocation;


                    //setSehriTime(my_data.sehri_time);


                    setIftarTime(my_data.iftar_time);

                    today_iftar = my_data.iftar_time;


                    document.getElementById('seheri_time').innerHTML = my_data.sehri_time;
                    document.getElementById('seheri_date').innerHTML = my_data.seheri_date;
                    document.getElementById('ifter_date').innerHTML = my_data.ifter_date;


                }
            };
            xhttp.open("GET", "https://kitefest.qubitsolutionlab.com/api/v1/get-ramadan-time", true);

            xhttp.send();

        }

      //  UserAction();


    </script>


@endsection
