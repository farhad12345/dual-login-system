<x-app-layout>
    <style>
        .back1{
        background-image: url('ff1.jpg');
        background-repeat: no-repeat;
        background-size: cover

    }
    </style>
     @section('title', 'Edit')
    <div class="container mt-5 back1">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center">تعديل المشروع</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Add PUT method for updating -->
                    <input type="hidden" value="{{ auth()->user()->id }}" name="employee_id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="employee_id" class="form-label">الموظف</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $project->employee_id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="company_name" class="form-label">اسم الشركة</label>
                            <input type="text" name="company_name" id="company_name"
                                class="form-control @error('company_name') is-invalid @enderror"
                                value="{{ old('company_name', $project->company_name) }}" required>
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
                            <input type="text" name="person_name" id="person_name"
                                class="form-control @error('person_name') is-invalid @enderror"
                                value="{{ old('person_name', $project->person_name) }}" required>
                            @error('person_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="service_required" class="form-label">الخدمة المطلوبة</label>
                            <input type="text" name="service_required" id="service_required"
                                class="form-control @error('service_required') is-invalid @enderror"
                                value="{{ old('service_required', $project->service_required) }}" required>
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
                            <input type="text" name="person_contact" id="person_contact"
                                class="form-control @error('person_contact') is-invalid @enderror"
                                value="{{ old('person_contact', $project->person_contact) }}" required>
                            @error('person_contact')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="service_type" class="form-label">نوع الخدمة</label>
                            <select name="service_type" id="service_type" class="form-control @error('service_type') is-invalid @enderror">
                                <option value="issuing_license" {{ $project->service_type == 'issuing_license' ? 'selected' : '' }}>إصدار رخصة</option>
                                <option value="foreign_investment" {{ $project->service_type == 'foreign_investment' ? 'selected' : '' }}>الاستثمار الأجنبي</option>
                                <option value="issuing_trade_mark" {{ $project->service_type == 'issuing_trade_mark' ? 'selected' : '' }}>إصدار علامة تجارية</option>
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
                            <input type="date" name="start_date" id="start_date"
                                class="form-control @error('start_date') is-invalid @enderror"
                                value="{{ old('start_date', $project->start_date) }}" required>
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
                                    <option {{ $project->days == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            {{-- <input type="number" name="days" id="completion_date"
                                class="form-control @error('days') is-invalid @enderror" required> --}}
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
                                <option value="started" {{ $project->status == 'started' ? 'selected' : '' }}>تم البدء</option>
                                <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">مدينة</label>
                            <input type="text" name="city" id="city"
                                class="form-control @error('city') is-invalid @enderror"
                                value="{{ old('city', $project->city) }}" required>
                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="person_name" class="form-label">البريد الإلكتروني</label>
                            <input type="text" name="email" id="email"
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
                            <input type="text"  value="{{ old('ministry', $project->ministry ?? '') }}" name="ministry" id="ministry"
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
                            <input type="text" name="commertial_register" id="commertial_register"
                                class="form-control @error('commertial_register') is-invalid @enderror"
                                value="{{ old('commertial_register', $project->commertial_register) }}" required>
                            @error('commertial_register')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="country" class="form-label">البلد</label>
                            <input type="text" value="{{ $project->country }}" name="country" id="country"
                                class="form-control @error('country') is-invalid @enderror" >
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
                                <option value="amirtam_khedmat" {{ old('status', $project->status) == 'amirtam_khedmat' ? 'selected' : '' }}>آمر تم لخدمات الأعمال </option>
                                <option value="wahaj_watan" {{ old('status', $project->status) == 'wahaj_watan' ? 'selected' : '' }}> وهج وطن العقارية</option>
                                <option value="alhojamat" {{ old('status', $project->status) == 'alhojamat' ? 'selected' : '' }}>منصة الجامعات</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="business_type" class="form-label">نوع النشاط التجاري</label>
                            <input type="text"  value="{{ $project->business_type }}" name="business_type" id="business_type"
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
                        <button type="submit" class="btn btn-success px-5">تحديث المشروع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
