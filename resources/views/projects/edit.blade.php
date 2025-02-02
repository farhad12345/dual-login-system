<x-app-layout>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center">تعديل المشروع</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ auth()->user()->id }}" name="employee_id">

                    <div class="row mb-3">
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
                    </div>

                    <div class="row mb-3">
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
                    </div>

                    <div class="row mb-3">
                        <!--<div class="col-md-6">-->
                        <!--    <label for="service_type" class="form-label">نوع الخدمة</label>-->
                        <!--    <select name="service_type" id="service_type" class="form-control @error('service_type') is-invalid @enderror">-->
                        <!--        <option value="">Select</option>-->
                        <!--        <option value="issuing_license" {{ old('service_type', $project->service_type) == 'issuing_license' ? 'selected' : '' }}>إصدار رخصة</option>-->
                        <!--        <option value="foreign_investment" {{ old('service_type', $project->service_type) == 'foreign_investment' ? 'selected' : '' }}>الاستثمار الأجنبي</option>-->
                        <!--        <option value="issuing_trade_mark" {{ old('service_type', $project->service_type) == 'issuing_trade_mark' ? 'selected' : '' }}>إصدار علامة تجارية</option>-->
                        <!--    </select>-->
                        <!--    @error('service_type')-->
                        <!--        <div class="invalid-feedback">-->
                        <!--            {{ $message }}-->
                        <!--        </div>-->
                        <!--    @enderror-->
                        <!--</div>-->
                            <div class="col-md-6">
                            <label for="days" class="form-label">عدد الأيام لإكمال</label>
                            <input type="number" name="days" id="completion_date"
                                class="form-control @error('days') is-invalid @enderror"
                                value="{{ old('days', $project->days) }}" required>
                            @error('days')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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
                    </div>

                    <div class="row mb-3">
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

                        <div class="col-md-6">
                            <label for="status" class="form-label">الحالة</label>
                            <select name="status" id="status" class="form-control">
                                <option value="started" {{ old('status', $project->status) == 'started' ? 'selected' : '' }}>تم البدء</option>
                                <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                                <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>مكتمل</option>
                                 <option value="under_study" {{ old('status', $project->status) == 'under_study' ? 'selected' : '' }}>تحت الدراسه</optio
                                 <option value="completed" {{ old('status', $project->status) == 'waiting_for_order' ? 'selected' : '' }}>انتظار الطلبات</option>
                                  <option value="completed" {{ old('status', $project->status) == 'authority_review' ? 'selected' : '' }}>المراجعه من الجهه</option>
                  
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                  
                       <div class="col-md-6">
                            <label for="business_type" class="form-label">السجل التجاري</label>
                            <input type="text"  value="{{ $project->business_type }}" name="business_type" id="business_type"
                                class="form-control @error('business_type') is-invalid @enderror" required>
                            @error('business_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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
                     <div class="row mb-3">
                   
                     </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success px-5">تحديث المشروع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
