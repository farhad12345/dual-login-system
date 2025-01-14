   <x-app-layout>
    @section('title', 'إضافة مشروع جديد')
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
                                        <select name="employee_id" id="employee_id" class="form-control">
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
                                        <label for="person_contact" class="form-label">رقم الاتصال</label>
                                        <input type="text" name="person_contact" placeholder="أدخل رقم الاتصال" id="person_contact"
                                            class="form-control @error('person_contact') is-invalid @enderror"
                                            value="{{ old('person_contact', $project->person_contact ?? '') }}" required>
                                        @error('person_contact')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="service_type" class="form-label">نوع الخدمة</label>
                                        <select name="service_type" id="service_type" class="form-control  @error('service_type') is-invalid @enderror">
                                            <option value="">Select </option>
                                            <option value="issuing_license">إصدار رخصة</option>
                                            <option value="foreign_investment">الاستثمار الأجنبي</option>
                                            <option value="issuing_trade_mark">إصدار علامة تجارية</option>
                                        </select>
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
                                        <input type="text" name="city" placeholder="أدخل المدينة" id="city"
                                            class="form-control @error('city') is-invalid @enderror" required>
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
                                        <input type="text" name="country" placeholder="أدخل البلد" id="country"
                                            class="form-control @error('country') is-invalid @enderror">
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
            </x-app-layout>

