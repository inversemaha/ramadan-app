@extends('layouts.common')

@section('content')

    @include('common.home.slider')

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

                        {{--  <div class="col-md-6">
                              <center>
                                  <table>
                                      <thead>
                                      <tr>
                                          <th>ঢাকার সময়ের সাথে যোগ করতে হবে</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr>
                                          <td>ঠাকুরগাঁও, নবাবগঞ্জ ০৮ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>দিনাজপুর , পঞ্চগড় ০৭ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>রাজশাহী , মেহেরপুর ০৬ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>জয়পুরহাট , সাতক্ষীরা ০৬ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>নাটোর, নীলফামারী ০৬ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>লালমনিরহাট , বগুড়া,যশোর ০৪ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>কুষ্টিয়া, ঝিনাইদহ,পাবনা,রংপুর ০৪ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>খুলনা,গাইবান্ধা,সিরাজগঞ্জ ০৩ মি.</td>
                                      </tr>
                                      <tr>

                                          <td>ফরিদপুর,বাগেরহাট,জামালপুর ০২ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>মাদারীপুর,বরিশাল,ঝালকাটি,পটুয়াখালী ০১ মি.</td>
                                      </tr>


                                      </tr>
                                      </tbody>


                                  </table>
                              </center>
                              <center>
                                  <table>
                                      <thead>
                                      <tr>
                                          <th>ঢাকার সময়ের সাথে বিয়োগ করতে হবে</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr>
                                          <td>বান্দরবান,রাঙামাটি ০৬ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>সিলেট,চট্টগ্রাম ০৫ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>সুনামগঞ্জ ,হবিগঞ্জ,ফেনী ০৪ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>কুমিল্লা ,ব্রাম্মণবাড়িয়া ,নোয়াখালী ০৩ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>ময়মনসিংহ ,কিশোরগঞ্জ ০২ মি.</td>
                                      </tr>
                                      <tr>
                                          <td>নরসিংদী ,মুন্সীগঞ্জ,চাঁদপুর,টাঙ্গাইল ০১ মি.</td>
                                      </tr>


                                      </tr>
                                      </tbody>


                                  </table>
                              </center>

                          </div>--}}


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
                            <span class="count-number">1</span>
                        </div><!-- single intro text end-->

                    </div>
                </div>
                <div class="col-md-4 nishiddo">
                    <div class="elementor-widget-container">
                        <div class="single-intro-text mb-5">
                            <i class="icon dripicons-time-reverse"></i>
                            <h3 class="ts-title">ঈদুল আযহা (কুরবানী) এর দিন। </h3>
                            <span class="count-number">2</span>
                        </div><!-- single intro text end-->

                    </div>
                </div>
                <div class="col-md-4 nishiddo">
                    <div class="elementor-widget-container">
                        <div class="single-intro-text mb-5">
                            <i class="icon dripicons-time-reverse"></i>
                            <h3 class="ts-title"> ঈদুল আযহার এর পরে আরো তিন দিন।</h3>
                            <span class="count-number">3</span>
                        </div><!-- single intro text end-->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="" id="full_time" style="background-color: #fbfbfb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-lg-12 mx-auto">
                        <h5 class="section-title">রোজার নিয়ত ও দোয়া</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="elementor-widget-container">
                                <div class="single-intro-text mb-5">
                                    <i class="icon dripicons-time-reverse"></i>
                                    <h3 class="ts-title">আরবি নিয়ত</h3>
                                    <p>
                                        নাওয়াইতু আন আছুম্মা গাদাম মিন শাহরি রমাজানাল মুবারাকি ফারদাল্লাকা, ইয়া আল্লাহু
                                        ফাতাকাব্বাল মিন্নি ইন্নিকা আনতাস সামিউল আলিম।
                                    </p>
                                    <span class="count-number">1</span>
                                </div><!-- single intro text end-->

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="elementor-widget-container">
                                <div class="single-intro-text mb-5">
                                    <i class="icon dripicons-time-reverse"></i>
                                    <h3 class="ts-title">বাংলায় নিয়ত</h3>
                                    <p>
                                        হে আল্লাহ! আমি আগামীকাল পবিত্র রমজানের তোমার পক্ষ থেকে নির্ধারিত ফরজ রোজা রাখার
                                        ইচ্ছা
                                        পোষণ (নিয়্যত) করলাম। অতএব তুমি আমার পক্ষ থেকে (আমার রোযা তথা পানাহার থেকে বিরত
                                        থাকাকে)
                                        কবুল কর, নিশ্চয়ই তুমি সর্বশ্রোতা ও সর্বজ্ঞানী।
                                    </p>
                                    <span class="count-number">2</span>
                                </div><!-- single intro text end-->

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="elementor-widget-container">
                                <div class="single-intro-text mb-5">
                                    <i class="icon dripicons-time-reverse"></i>
                                    <h3 class="ts-title">ইফতারের দোয়া</h3>
                                    <p>
                                        আল্লাহুম্মা লাকা ছুমতু ওয়া আলা রিযক্বিকা ওয়া আফতারতু বিরাহমাতিকা ইয়া আরহামার
                                        রাহিমিন।
                                    </p>
                                    <span class="count-number">3</span>
                                </div><!-- single intro text end-->

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="col-lg-12 mx-auto">
                        <h2 class="section-title roja-title text-center" style="padding-top: 50px; !important;">
                            রহমতের ১০ দিন
                        </h2>
                    </div>
                    <div class="col-lg-12 mx-auto">
                        <table
                            class="table table-responsive table-bordered  table-condensed table-hover">
                            <tr>
                                <th>রমজান</th>
                                <th>তারিখ</th>
                                <th>সেহেরির শেষ সময়</th>
                                <th>ইফতারের শেষ সময়</th>


                            </tr>

                            <tr>
                                <td> ১</td>
                                <td> রবিবার, এপ্রিল ০৩, ২০২২</td>
                                <td>৪ঃ২৭ মিনিট</td>
                                <td>৬ঃ১৯ মিনিট</td>

                            </tr>
                            <tr>
                                <td> ২</td>
                                <td> সোমবার, এপ্রিল ০৪, ২০২২</td>
                                <td>৪ঃ২৬ মিনিট</td>
                                <td>৬ঃ১৯ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ৩</td>
                                <td> মঙ্গলবার, এপ্রিল ০৫, ২০২২</td>
                                <td>৪ঃ২৪ মিনিট</td>
                                <td>৬ঃ২০ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ৪</td>
                                <td> বুধবার, এপ্রিল ০৬, ২০২২</td>
                                <td>৪ঃ২৪ মিনিট</td>
                                <td>৬ঃ২০ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ৫</td>
                                <td> বৃহস্পতিবার, এপ্রিল ০৭, ২০২২</td>
                                <td>৪ঃ২৩ মিনিট</td>
                                <td>৬ঃ২১ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ৬</td>
                                <td> শুক্রবার, এপ্রিল ০৮, ২০২২</td>
                                <td>৪ঃ২২ মিনিট</td>
                                <td>৬ঃ২১ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ৭</td>
                                <td> শনিবার, এপ্রিল ০৯, ২০২২</td>
                                <td>৪ঃ২১ মিনিট</td>
                                <td>৬ঃ২১ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ৮</td>
                                <td> রবিবার, এপ্রিল ১০, ২০২২</td>
                                <td>৪ঃ২০ মিনিট</td>
                                <td>৬ঃ২২ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ৯</td>
                                <td> সোমবার, এপ্রিল ১১, ২০২২</td>
                                <td>৪ঃ১৯ মিনিট</td>
                                <td>৬ঃ২২ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ১০</td>
                                <td> মঙ্গলবার, এপ্রিল ১২, ২০২২</td>
                                <td>৪ঃ১৮ মিনিট</td>
                                <td>৬ঃ২৩ মিনিট</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="col-lg-12 mx-auto">
                        <h2 class="section-title roja-title text-center" style="padding-top: 50px; !important;">
                            মাগফিরাতের ১০ দিন
                        </h2>
                    </div>
                    <div class="col-lg-12 mx-auto">
                        <table
                            class="table table-responsive table-bordered  table-condensed table-hover">
                            <tr>
                                <th>রমজান</th>
                                <th>তারিখ</th>
                                <th>সেহেরির শেষ সময়</th>
                                <th>ইফতারের শেষ সময়</th>
                            </tr>
                            <tr>
                                <td> ১১</td>
                                <td> বুধবার, এপ্রিল ১৩, ২০২২</td>
                                <td>৪ঃ১৭ মিনিট</td>
                                <td>৬ঃ২৩ মিনিট</td>

                            </tr>
                            <tr>
                                <td> ১২</td>
                                <td> বৃহস্পতিবার, এপ্রিল ১৪, ২০২২</td>
                                <td>৪ঃ১৫ মিনিট</td>
                                <td>৬ঃ২৩ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ১৩</td>
                                <td> শুক্রবার, এপ্রিল ১৫, ২০২২</td>
                                <td>৪ঃ১৪ মিনিট</td>
                                <td>৬ঃ২৪ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ১৪</td>
                                <td> শনিবার, এপ্রিল ১৬, ২০২২</td>
                                <td>৪ঃ১৩ মিনিট</td>
                                <td>৬ঃ২৪ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ১৫</td>
                                <td> রবিবার, এপ্রিল ১৭, ২০২২</td>
                                <td>৪ঃ১২ মিনিট</td>
                                <td>৬ঃ২৪ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ১৬</td>
                                <td> সোমবার, এপ্রিল ১৮, ২০২২</td>
                                <td>৪ঃ১১ মিনিট</td>
                                <td>৬ঃ২৫ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ১৭</td>
                                <td> মঙ্গলবার, এপ্রিল ১৯, ২০২২</td>
                                <td>৪ঃ১০ মিনিট</td>
                                <td>৬ঃ২৫ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ১৮</td>
                                <td> বুধবার, এপ্রিল ২০, ২০২২</td>
                                <td>৪ঃ০৯ মিনিট</td>
                                <td>৬ঃ২৬ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ১৯</td>
                                <td> বৃহস্পতিবার, এপ্রিল ২১, ২০২২</td>
                                <td>৪ঃ০৮ মিনিট</td>
                                <td>৬ঃ২৬ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ২০</td>
                                <td> শুক্রবার, এপ্রিল ২২, ২০২২</td>
                                <td>৪ঃ০৭ মিনিট</td>
                                <td>৬ঃ২৭ মিনিট</td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-lg-12 mx-auto">
                        <h2 class="section-title roja-title text-center" style="padding-top: 50px; !important;">
                            নাজাতের ১০ দিন
                        </h2>
                    </div>

                    <div class="col-lg-12 mx-auto">
                        <table
                            class="table table-responsive table-bordered  table-condensed table-hover">
                            <tr>
                                <th>রমজান</th>
                                <th>তারিখ</th>
                                <th>সেহেরির শেষ সময়</th>
                                <th>ইফতারের শেষ সময়</th>
                            </tr>
                            <tr>
                                <td> ২১</td>
                                <td> শনিবার, এপ্রিল ২৩, ২০২২</td>
                                <td>৪ঃ০৬ মিনিট</td>
                                <td>৬ঃ২৭ মিনিট</td>

                            </tr>
                            <tr>
                                <td> ২২</td>
                                <td> রবিবার, এপ্রিল ২৪, ২০২২</td>
                                <td>৪ঃ০৫ মিনিট</td>
                                <td>৬ঃ২৮ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ২৩</td>
                                <td> সোমবার, এপ্রিল ২৫, ২০২২</td>
                                <td>৪ঃ০৫ মিনিট</td>
                                <td>৬ঃ২৮ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ২৪</td>
                                <td> মঙ্গলবার, এপ্রিল ২৬, ২০২২</td>
                                <td>৪ঃ০৪ মিনিট</td>
                                <td>৬ঃ২৯ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ২৫</td>
                                <td> বুধবার, এপ্রিল ২৭, ২০২২</td>
                                <td>৪ঃ০৩ মিনিট</td>
                                <td>৬ঃ২৯ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ২৬</td>
                                <td> বৃহস্পতিবার, এপ্রিল ২৮, ২০২২</td>
                                <td>৪ঃ০২ মিনিট</td>
                                <td>৬ঃ২৯ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ২৭</td>
                                <td> শুক্রবার, এপ্রিল ২৯, ২০২২</td>
                                <td>৪ঃ০১ মিনিট</td>
                                <td>৬ঃ৩০ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ২৮</td>
                                <td> শনিবার, এপ্রিল ৩০, ২০২২</td>
                                <td>৪ঃ০০ মিনিট</td>
                                <td>৬ঃ৩০ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ২৯</td>
                                <td> রবিবার, মে ০১ ,<br> ২০২২</td>
                                <td>৩ঃ৫৯ মিনিট</td>
                                <td>৬ঃ৩১ মিনিট</td>
                            </tr>
                            <tr>
                                <td> ৩০</td>
                                <td> সোমবার, মে ০২, <br> ২০২২</td>
                                <td>৩ঃ৫৮ মিনিট</td>
                                <td>৬ঃ৩১ মিনিট</td>
                            </tr>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>








    <script type="text/javascript">
        document.getElementById('zila').style.display = 'none';
        document.getElementById('zila_seheri').style.display = 'none';


        function addMinute(minute) {
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

        UserAction();


    </script>


@endsection
