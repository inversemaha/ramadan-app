<style>
    .fajr {
        width: 20px;
        height: 20px;
        background-size: cover;
    }
</style>

<section class="" id="ad">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="section-title">আপনার জেলা নির্বাচন করে সেহেরি ও ইফতারের সময় দেখুন</h5>
            </div>
            <div class="col-md-6">

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
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <p>এই সময়সূচি ঢাকা অঞ্চলের জন্য প্রযোজ্য</p>
                            </div>
                            <div class="col-md-6">

                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name of Salat</th>
                                        <th>Azan Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><img class="fajr" src="/icons/1.png"></img>Fajr</td>
                                        <td>03.30 am</td>
                                    </tr>
                                    <tr>
                                        <td>Dhuhr</td>
                                        <td>01.30 pm</td>
                                    </tr>
                                    <tr>
                                        <td>Asar</td>
                                        <td>05.10 pm</td>
                                    </tr>
                                    <tr>
                                        <td><img src=""></img>Magrib</td>
                                        <td>06.50 pm</td>
                                    </tr>
                                    <tr>
                                        <td>Isha</td>
                                        <td>08.30 pm</td>
                                    </tr>
                                    <tr>
                                        <td>Jumah</td>
                                        <td>12.30 pm</td>
                                    </tr>
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
