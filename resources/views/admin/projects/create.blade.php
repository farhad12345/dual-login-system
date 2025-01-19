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
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white" id="firstFormHeader">
            <h4 class="mb-0 text-center">إضافة مشروع جديد - الخطوة الأولى</h4>
        </div>
        <div class="card-body">
            <form id="combinedForm" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- First Form Fields -->
                <div id="firstFormFields">
                    <div class="row mb-3">
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
                            <label for="service_type" class="form-label">نوع الخدمة</label>
                            <input type="text" name="service_type" placeholder="نوع الخدمة" id="service_type"
                                class="form-control @error('service_type') is-invalid @enderror" required>
                            @error('service_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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
                            <label for="type" class="form-label">القسم</label>
                            <select name="type" id="type" class="form-control">
                                <option value="amirtam_khedmat">آمر تم لخدمات الأعمال </option>
                                <option value="wahaj_watan">وهج وطن العقارية</option>
                                <option value="alhojamat">منصة الجامعات</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Second Form Fields -->
                <div id="secondFormFields" class="d-none">
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
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">رقم التواصل</label>
                            <div class="input-group">
                                <select name="country_code" id="country_code" class="select form-control @error('country_code') is-invalid @enderror" >
                                    @foreach ($countryCodesWithNames as $country)
                                    <option value="{{ $country['code'] }}">{{ $country['code'] }} ({{ $country['name'] }})</option>
                                @endforeach
                                <input type="tel" name="person_contact" id="phone" class="form-control @error('person_contact') is-invalid @enderror">
                            </div>
                            @error('person_contact')
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
                            <label for="city" class="form-label">مدينة</label>
                            <select name="cities" class="form-control selectcity" id="cities">
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
                        <div class="col-md-6">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="text" name="email" placeholder="أدخل البريد الإلكتروني" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $project->email ?? '') }}" >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="country" class="form-label">البلد</label>
                            @foreach ($countryNames as $name)
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                            @error('country')
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
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" id="backButton" class="btn btn-secondary px-5 d-none">السابق</button>
                    <button type="button" id="nextButton" class="btn btn-success px-5">التالي</button>
                    <button type="submit" id="submitButton" class="btn btn-primary px-5 d-none">حفظ المشروع</button>
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
    const nextButton = document.getElementById('nextButton');
    const backButton = document.getElementById('backButton');
    const submitButton = document.getElementById('submitButton');
    const firstFormFields = document.getElementById('firstFormFields');
    const secondFormFields = document.getElementById('secondFormFields');

    nextButton.addEventListener('click', () => {
        if (firstFormFields.querySelectorAll(':invalid').length === 0) {
            firstFormFields.classList.add('d-none');
            secondFormFields.classList.remove('d-none');
            nextButton.classList.add('d-none');
            submitButton.classList.remove('d-none');
            backButton.classList.remove('d-none');
        } else {
            firstFormFields.querySelector(':invalid').focus();
        }
    });

    backButton.addEventListener('click', () => {
        secondFormFields.classList.add('d-none');
        firstFormFields.classList.remove('d-none');
        nextButton.classList.remove('d-none');
        submitButton.classList.add('d-none');
        backButton.classList.add('d-none');
    });
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
 console.log(countryCode);
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

