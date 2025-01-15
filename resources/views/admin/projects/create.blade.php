   <x-app-layout>
    @section('title', 'إضافة مشروع جديد')
    <style>
  .input-group {
    display: flex;
    align-items: center;
}

.input-group select {
    width: 120px; /* Set a smaller width for the country code dropdown */
    padding-left: 10px; /* Add some padding for better alignment */
}

.input-group input {
    flex-grow: 1; /* The input will take the remaining space */
}

.select2-container .select2-selection--single {
    height: 43px; /* Adjust the height as needed */
    display: flex;
    align-items: center; /* Center the text vertically */
    padding: 6px; /* Add padding for better appearance */
    font-size: 14px; /* Adjust font size */
}

.select2-container--default .select2-selection--single {
    border: 1px solid #ccc; /* Border style */
    border-radius: 4px; /* Rounded corners */
    background-color: #fff; /* Background color */
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%; /* Ensure arrow matches height */
}

    </style>
                <div class="container mt-5"  >
                    <div class="card shadow-sm" >
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0 text-center">إضافة مشروع جديد</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="employee_id" class="form-label">الموظف</label>
                                        <select name="employee_id" id="employee_id" class="form-control selectemploye">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="company_name" class="form-label">اسم الشركة</label>
                                        <input type="text" name="company_name" placeholder="أدخل اسم الشركة" id="company_name"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            value="{{ old('company_name', $project->company_name ?? '') }}" required>
                                        @error('company_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="person_name" class="form-label">اسم الشخص</label>
                                        <input type="text" name="person_name" placeholder="أدخل اسم الشخص" id="person_name"
                                            class="form-control @error('person_name') is-invalid @enderror"
                                            value="{{ old('person_name', $project->person_name ?? '') }}" required>
                                        @error('person_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="service_required" class="form-label">الخدمة المطلوبة</label>
                                        <input type="text" name="service_required" placeholder="أدخل الخدمة المطلوبة" id="service_required"
                                            class="form-control @error('service_required') is-invalid @enderror" required>
                                        @error('service_required')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">رقم التواصل</label>
                                        <div class="input-group">
                                            <!-- Country code dropdown -->
                                            <select name="country_code" id="country_code" class="select form-control @error('country_code') is-invalid @enderror" required>
                                                <option value="+1">+1 (USA)</option>
                                                <option value="+93">+93 (Afghanistan)</option>
                                                <option value="+355">+355 (Albania)</option>
                                                <option value="+213">+213 (Algeria)</option>
                                                <option value="+376">+376 (Andorra)</option>
                                                <option value="+244">+244 (Angola)</option>
                                                <option value="+54">+54 (Argentina)</option>
                                                <option value="+374">+374 (Armenia)</option>
                                                <option value="+61">+61 (Australia)</option>
                                                <option value="+43">+43 (Austria)</option>
                                                <option value="+994">+994 (Azerbaijan)</option>
                                                <option value="+973">+973 (Bahrain)</option>
                                                <option value="+880">+880 (Bangladesh)</option>
                                                <option value="+375">+375 (Belarus)</option>
                                                <option value="+32">+32 (Belgium)</option>
                                                <option value="+501">+501 (Belize)</option>
                                                <option value="+229">+229 (Benin)</option>
                                                <option value="+975">+975 (Bhutan)</option>
                                                <option value="+591">+591 (Bolivia)</option>
                                                <option value="+387">+387 (Bosnia and Herzegovina)</option>
                                                <option value="+267">+267 (Botswana)</option>
                                                <option value="+55">+55 (Brazil)</option>
                                                <option value="+673">+673 (Brunei)</option>
                                                <option value="+359">+359 (Bulgaria)</option>
                                                <option value="+226">+226 (Burkina Faso)</option>
                                                <option value="+257">+257 (Burundi)</option>
                                                <option value="+855">+855 (Cambodia)</option>
                                                <option value="+237">+237 (Cameroon)</option>
                                                <option value="+1">+1 (Canada)</option>
                                                <option value="+238">+238 (Cape Verde)</option>
                                                <option value="+236">+236 (Central African Republic)</option>
                                                <option value="+235">+235 (Chad)</option>
                                                <option value="+56">+56 (Chile)</option>
                                                <option value="+86">+86 (China)</option>
                                                <option value="+57">+57 (Colombia)</option>
                                                <option value="+269">+269 (Comoros)</option>
                                                <option value="+242">+242 (Congo)</option>
                                                <option value="+243">+243 (Congo, Democratic Republic of the)</option>
                                                <option value="+506">+506 (Costa Rica)</option>
                                                <option value="+385">+385 (Croatia)</option>
                                                <option value="+53">+53 (Cuba)</option>
                                                <option value="+357">+357 (Cyprus)</option>
                                                <option value="+420">+420 (Czech Republic)</option>
                                                <option value="+45">+45 (Denmark)</option>
                                                <option value="+253">+253 (Djibouti)</option>
                                                <option value="+1">+1 (Dominica)</option>
                                                <option value="+1">+1 (Dominican Republic)</option>
                                                <option value="+593">+593 (Ecuador)</option>
                                                <option value="+20">+20 (Egypt)</option>
                                                <option value="+503">+503 (El Salvador)</option>
                                                <option value="+240">+240 (Equatorial Guinea)</option>
                                                <option value="+291">+291 (Eritrea)</option>
                                                <option value="+372">+372 (Estonia)</option>
                                                <option value="+251">+251 (Ethiopia)</option>
                                                <option value="+679">+679 (Fiji)</option>
                                                <option value="+358">+358 (Finland)</option>
                                                <option value="+33">+33 (France)</option>
                                                <option value="+241">+241 (Gabon)</option>
                                                <option value="+220">+220 (Gambia)</option>
                                                <option value="+995">+995 (Georgia)</option>
                                                <option value="+49">+49 (Germany)</option>
                                                <option value="+233">+233 (Ghana)</option>
                                                <option value="+30">+30 (Greece)</option>
                                                <option value="+502">+502 (Guatemala)</option>
                                                <option value="+224">+224 (Guinea)</option>
                                                <option value="+245">+245 (Guinea-Bissau)</option>
                                                <option value="+592">+592 (Guyana)</option>
                                                <option value="+509">+509 (Haiti)</option>
                                                <option value="+504">+504 (Honduras)</option>
                                                <option value="+36">+36 (Hungary)</option>
                                                <option value="+354">+354 (Iceland)</option>
                                                <option value="+91">+91 (India)</option>
                                                <option value="+62">+62 (Indonesia)</option>
                                                <option value="+98">+98 (Iran)</option>
                                                <option value="+964">+964 (Iraq)</option>
                                                <option value="+353">+353 (Ireland)</option>
                                                <option value="+972">+972 (Israel)</option>
                                                <option value="+39">+39 (Italy)</option>
                                                <option value="+225">+225 (Ivory Coast)</option>
                                                <option value="+81">+81 (Japan)</option>
                                                <option value="+962">+962 (Jordan)</option>
                                                <option value="+7">+7 (Kazakhstan)</option>
                                                <option value="+254">+254 (Kenya)</option>
                                                <option value="+686">+686 (Kiribati)</option>
                                                <option value="+965">+965 (Kuwait)</option>
                                                <option value="+996">+996 (Kyrgyzstan)</option>
                                                <option value="+856">+856 (Laos)</option>
                                                <option value="+371">+371 (Latvia)</option>
                                                <option value="+961">+961 (Lebanon)</option>
                                                <option value="+266">+266 (Lesotho)</option>
                                                <option value="+231">+231 (Liberia)</option>
                                                <option value="+218">+218 (Libya)</option>
                                                <option value="+423">+423 (Liechtenstein)</option>
                                                <option value="+370">+370 (Lithuania)</option>
                                                <option value="+352">+352 (Luxembourg)</option>
                                                <option value="+261">+261 (Madagascar)</option>
                                                <option value="+265">+265 (Malawi)</option>
                                                <option value="+60">+60 (Malaysia)</option>
                                                <option value="+960">+960 (Maldives)</option>
                                                <option value="+223">+223 (Mali)</option>
                                                <option value="+356">+356 (Malta)</option>
                                                <option value="+692">+692 (Marshall Islands)</option>
                                                <option value="+222">+222 (Mauritania)</option>
                                                <option value="+230">+230 (Mauritius)</option>
                                                <option value="+52">+52 (Mexico)</option>
                                                <option value="+691">+691 (Micronesia)</option>
                                                <option value="+373">+373 (Moldova)</option>
                                                <option value="+377">+377 (Monaco)</option>
                                                <option value="+976">+976 (Mongolia)</option>
                                                <option value="+382">+382 (Montenegro)</option>
                                                <option value="+212">+212 (Morocco)</option>
                                                <option value="+258">+258 (Mozambique)</option>
                                                <option value="+95">+95 (Myanmar)</option>
                                                <option value="+264">+264 (Namibia)</option>
                                                <option value="+977">+977 (Nepal)</option>
                                                <option value="+31">+31 (Netherlands)</option>
                                                <option value="+64">+64 (New Zealand)</option>
                                                <option value="+505">+505 (Nicaragua)</option>
                                                <option value="+227">+227 (Niger)</option>
                                                <option value="+234">+234 (Nigeria)</option>
                                                <option value="+47">+47 (Norway)</option>
                                                <option value="+968">+968 (Oman)</option>
                                                <option value="+92">+92 (Pakistan)</option>
                                                <option value="+680">+680 (Palau)</option>
                                                <option value="+970">+970 (Palestine)</option>
                                                <option value="+507">+507 (Panama)</option>
                                                <option value="+675">+675 (Papua New Guinea)</option>
                                                <option value="+595">+595 (Paraguay)</option>
                                                <option value="+51">+51 (Peru)</option>
                                                <option value="+63">+63 (Philippines)</option>
                                                <option value="+48">+48 (Poland)</option>
                                                <option value="+351">+351 (Portugal)</option>
                                                <option value="+974">+974 (Qatar)</option>
                                                <option value="+242">+242 (Republic of the Congo)</option>
                                                <option value="+40">+40 (Romania)</option>
                                                <option value="+7">+7 (Russia)</option>
                                                <option value="+250">+250 (Rwanda)</option>
                                                <option value="+685">+685 (Samoa)</option>
                                                <option value="+378">+378 (San Marino)</option>
                                                <option value="+966">+966 (Saudi Arabia)</option>
                                                <option value="+221">+221 (Senegal)</option>
                                                <option value="+381">+381 (Serbia)</option>
                                                <option value="+248">+248 (Seychelles)</option>
                                                <option value="+232">+232 (Sierra Leone)</option>
                                                <option value="+65">+65 (Singapore)</option>
                                                <option value="+421">+421 (Slovakia)</option>
                                                <option value="+386">+386 (Slovenia)</option>
                                                <option value="+677">+677 (Solomon Islands)</option>
                                                <option value="+252">+252 (Somalia)</option>
                                                <option value="+27">+27 (South Africa)</option>
                                                <option value="+82">+82 (South Korea)</option>
                                                <option value="+211">+211 (South Sudan)</option>
                                                <option value="+34">+34 (Spain)</option>
                                                <option value="+94">+94 (Sri Lanka)</option>
                                                <option value="+249">+249 (Sudan)</option>
                                                <option value="+597">+597 (Suriname)</option>
                                                <option value="+46">+46 (Sweden)</option>
                                                <option value="+41">+41 (Switzerland)</option>
                                                <option value="+963">+963 (Syria)</option>
                                                <option value="+886">+886 (Taiwan)</option>
                                                <option value="+992">+992 (Tajikistan)</option>
                                                <option value="+255">+255 (Tanzania)</option>
                                                <option value="+66">+66 (Thailand)</option>
                                                <option value="+228">+228 (Togo)</option>
                                                <option value="+676">+676 (Tonga)</option>
                                                <option value="+216">+216 (Tunisia)</option>
                                                <option value="+90">+90 (Turkey)</option>
                                                <option value="+993">+993 (Turkmenistan)</option>
                                                <option value="+688">+688 (Tuvalu)</option>
                                                <option value="+256">+256 (Uganda)</option>
                                                <option value="+380">+380 (Ukraine)</option>
                                                <option value="+971">+971 (United Arab Emirates)</option>
                                                <option value="+44">+44 (United Kingdom)</option>
                                                <option value="+1">+1 (United States)</option>
                                                <option value="+598">+598 (Uruguay)</option>
                                                <option value="+998">+998 (Uzbekistan)</option>
                                                <option value="+678">+678 (Vanuatu)</option>
                                                <option value="+58">+58 (Venezuela)</option>
                                                <option value="+84">+84 (Vietnam)</option>
                                                <option value="+967">+967 (Yemen)</option>
                                                <option value="+260">+260 (Zambia)</option>
                                                <option value="+263">+263 (Zimbabwe)</option>

                                            </select>

                                            <!-- Phone number input -->
                                            <input type="tel" name="person_contact" id="phone" class="form-control @error('person_contact') is-invalid @enderror"
                                                   pattern="\d{10}" maxlength="10" minlength="10" required
                                                   title="Phone number must be exactly 10 digits">
                                                   @error('person_contact')
                                                   <div class="invalid-feedback">
                                                       {{ $message }}
                                                   </div>
                                               @enderror
                                                </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label for="person_contact" class="form-label">رقم الاتصال</label>
                                        <input type="text" name="person_contact" placeholder="أدخل رقم الاتصال" id="person_contact"
                                            class="form-control @error('person_contact') is-invalid @enderror"
                                            value="{{ old('person_contact', $project->person_contact ?? '') }}" required>
                                        @error('person_contact')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> --}}

                                    <div class="col-md-6">
                                        <label for="service_type" class="form-label">نوع الخدمة</label>
                                        {{-- <select name="service_type" id="service_type" class="form-control  @error('service_type') is-invalid @enderror">
                                            <option value="">Select </option>
                                            <option value="issuing_license">إصدار رخصة</option>
                                            <option value="foreign_investment">الاستثمار الأجنبي</option>
                                            <option value="issuing_trade_mark">إصدار علامة تجارية</option>
                                        </select>
                                        @error('service_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div> --}}
                                            <input type="text" name="service_type" placeholder="نوع الخدمة" id="service_type"
                                                class="form-control @error('service_type') is-invalid @enderror" required>
                                                @error('service_type')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="start_date" class="form-label">تاريخ البدء</label>
                                        <input type="date" name="start_date" placeholder="حدد تاريخ البدء" id="start_date"
                                            class="form-control @error('start_date') is-invalid @enderror" required>
                                        @error('start_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="days" class="form-label">عدد الأيام لإكمال</label>
                                        <select id="days" name="days" class="form-select">
                                            <option value="" disabled selected>اختر عدد الأيام</option>
                                            @for ($i = 1; $i <= 30; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('days')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">الحالة</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="started">تم البدء</option>
                                            <option value="in_progress">قيد التنفيذ</option>
                                            <option value="completed">مكتمل</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city" class="form-label">مدينة</label>
                                        {{-- <input type="text" name="city" placeholder="أدخل المدينة" id="city"
                                            class="form-control @error('city') is-invalid @enderror" required> --}}
                                            <select name="cities" class="form-control selectcity" id="cities">
                                                <option value="">المدينة</option>
                                                <option value="مكة المكرمة">مكة المكرمة</option>
                                                <option value="المدينة المنورة">المدينة المنورة</option>
                                                <option value="الرياض">الرياض</option>
                                                <option value="جدة">جدة</option>
                                                <option value="أبها">أبها</option>
                                                <option value="حائل">حائل</option>
                                                <option value="الباحة">الباحة</option>
                                                <option value="بريدة">بريدة</option>
                                                <option value="تبوك">تبوك</option>
                                                <option value="جازان">جازان</option>
                                                <option value="الدمام">الدمام</option>
                                                <option value="سكاكا">سكاكا</option>
                                                <option value="عرعر">عرعر</option>
                                                <option value="نجران">نجران</option>
                                            </select>

                                        @error('city')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">البريد الإلكتروني</label>
                                        <input type="text" name="email" placeholder="أدخل البريد الإلكتروني" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $project->email ?? '') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ministry" class="form-label">الوزارة</label>
                                        <input type="text" name="ministry" placeholder="أدخل اسم الوزارة" id="ministry"
                                            class="form-control @error('ministry') is-invalid @enderror" required>
                                        @error('ministry')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="commertial_register" class="form-label">السجل التجاري</label>
                                        <input type="text" placeholder="أدخل السجل التجاري" value="#" name="commertial_register" id="commertial_register"
                                            class="form-control @error('commertial_register') is-invalid @enderror" required>
                                        @error('commertial_register')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="country" class="form-label">البلد</label>
                                        {{-- <input type="text" name="country" placeholder="أدخل البلد" id="country"
                                            class="form-control @error('country') is-invalid @enderror"> --}}
                                            <select name="country" class="form-control selectcountry" id="country">
                                                <option value="">البلد</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="BN">Brunei</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="CV">Cabo Verde</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo</option>
                                                <option value="CD">Congo (DRC)</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czechia</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="SZ">Eswatini</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GR">Greece</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KR">Korea (South)</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Laos</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia</option>
                                                <option value="MD">Moldova</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="ME">Montenegro</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PW">Palau</option>
                                                <option value="PS">Palestine</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="QA">Qatar</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russia</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">Sao Tome and Principe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syria</option>
                                                <option value="TW">Taiwan</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TL">Timor-Leste</option>
                                                <option value="TG">Togo</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US">United States</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VA">Vatican City</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                              </select>

                                        @error('country')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="type" class="form-label">القسم</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="amirtam_khedmat">آمر تم لخدمات الأعمال </option>
                                            <option value="wahaj_watan"> وهج وطن العقارية</option>
                                            <option value="alhojamat">منصة الجامعات</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="business_type" class="form-label">نوع النشاط التجاري</label>
                                        <input type="text" placeholder="أدخل نوع النشاط التجاري" name="business_type" id="business_type"
                                            class="form-control @error('business_type') is-invalid @enderror" required>
                                        @error('business_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="document" class="form-label">المستند</label>
                                        <input type="file" name="document" id="document"
                                            class="form-control @error('document') is-invalid @enderror">
                                        @error('document')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success px-5">حفظ المشروع</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                {{-- <div class="col-md-6">
                    <label for="file" class="form-label">المرفقات</label>
                    <input type="file" name="file" id="file"
                        class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}
                {{-- <div class="col-md-6">
                    <label for="days" class="form-label">عدد الأيام لإكمال</label>
                    <select id="days" name="days" class="form-select">
                        <option value="" disabled selected>اختر عدد الأيام</option>
                        @for ($i = 1; $i <= 30; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    @error('days')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}


<script>

$(document).ready(function() {
    // Initialize Select2
    $('.select').select2({
        placeholder: "اختر رمز الدولة",// Placeholder text
        width: '20%' , // Adjust width as needed,
        height: '100%'
    });
    $('.selectcountry').select2({
    placeholder: "اختر الدولة", // Arabic placeholder for "Select Country"
    width: '100%', // Adjust width as needed
    height: '100%' // Adjust height if necessary
});

$('.selectcity').select2({
    placeholder: "اختر المدينة", // Arabic placeholder for "Select City"
    width: '100%', // Adjust width as needed
    height: '100%' // Adjust height if necessary
});
$('.selectemploye').select2({
    placeholder: "اختر المدينة", // Arabic placeholder for "Select City"
    width: '100%', // Adjust width as needed
    height: '100%' // Adjust height if necessary
});

    // Listen for Select2 change event
    $('#country_code').on('change', function() {
        var countryCode = $(this).val(); // Get the selected country code
        var phoneInput = $('#phone'); // Get the phone input field

        // If the phone input already has a value, replace the country code
        if (phoneInput.val()) {
            phoneInput.val(phoneInput.val().replace(/^\+?\d*/, countryCode));
        } else {
            phoneInput.val(countryCode); // Set the phone input value to the selected country code
        }
    });
});


</script>
            </x-app-layout>

