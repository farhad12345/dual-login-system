<x-wahaj-layout>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center">إضافة مشروع جديد</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('wahajwatan.project.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $id }}" name="employee_id">
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
                            <label for="record_number" class="form-label">رقم السجل</label>
                            <input type="text" name="record_number" placeholder="رقم السجل" id="record_number"
                                class="form-control @error('record_number') is-invalid @enderror"
                                value="{{ old('record_number', $project->record_number ?? '') }}" required>
                            @error('record_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="license_number" class="form-label">رقم رخصة فال</label>
                            <input type="text" name="license_number" placeholder="رقم رخصة فال" id="license_number"
                                class="form-control @error('license_number') is-invalid @enderror"
                                value="{{ old('license_number', $project->license_number ?? '') }}" required>
                            @error('license_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="origin_name" class="form-label">اسم المنشأ</label>
                            <input type="text" name="origin_name" placeholder="اسم المنشأ" id="origin_name"
                            value="{{ old('origin_name', $project->origin_name ?? '') }}"  class="form-control @error('origin_name') is-invalid @enderror" required>
                            @error('origin_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">الايميل</label>
                            <input type="text" name="email" placeholder="رقم رخصة فال" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $project->email ?? '') }}" value="{{ old('email', $project->email ?? '') }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">رقم الهاتف</label>
                            <input type="text" name="phone_number" placeholder="رقم الهاتف" id="phone_number"
                            value="{{ old('phone_number', $project->phone_number ?? '') }}"    class="form-control @error('phone_number') is-invalid @enderror" required>
                            @error('phone_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="person_name" class="form-label">الخدمة</label>
                            <select name="service" id="service" class="form-control  @error('service') is-invalid @enderror">
                                <option value="">Select </option>
                                <option value="record_number">بيع</option>
                                <option value="buying">شراء</option>
                                <option value="investement">استثمار</option>
                            </select>
                            @error('service')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="site_link" class="form-label">الموقع</label>
                            <input type="text" name="site_link" placeholder="رقم الهاتف" id="site_link"
                            value="{{ old('site_link', $project->site_link ?? '') }}"  class="form-control @error('site_link') is-invalid @enderror" required>
                            @error('site_link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="property_type" class="form-label">نوع العقار</label>
                            <select name="property_type" id="property_type" class="form-control @error('property_type') is-invalid @enderror" onchange="toggleOtherField()">
                                <option value="">Select </option>
                                <option value="land">ارض</option>
                                <option value="building">عمارة</option>
                                <option value="villa">فله</option>
                                <option value="apartment">شقة</option>
                                <option value="hotel">فندق</option>
                                <option value="mall">مول</option>
                                <option value="indutrial_land">ارض صناعية</option>
                                <option value="commertial_warehous">مستودعات تجارية</option>
                                <option value="gas_stattion">محطات وقود</option>
                                <option value="failure">قصور</option>
                                <option value="farm">مزارع</option>
                                <option value="other">أخرى</option>
                            </select>
                            @error('property_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6" id="otherField" style="display: none;">
                            <label for="other" class="form-label">أخرى</label>
                            <input type="text" name="other" placeholder="" id="other"
                            value="{{ old('other', $project->other ?? '') }}"  class="form-control @error('other') is-invalid @enderror">
                            @error('other')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="area" class="form-label">المساحة</label>
                            <input type="text" name="area" placeholder="المساحة" id="area"
                            value="{{ old('area', $project->area ?? '') }}"  class="form-control @error('area') is-invalid @enderror"
                                value="{{ old('area', $project->area ?? '') }}" required>
                            @error('area')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="height" class="form-label">الطول</label>
                            <input type="text" name="height" placeholder="حدد تاريخ البدء" id="height"
                            value="{{ old('height', $project->height ?? '') }}"  class="form-control @error('height') is-invalid @enderror" required>
                            @error('height')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="width" class="form-label">العرض</label>
                            <input type="text" name="width" placeholder="العرض" id="width"
                            value="{{ old('width', $project->width ?? '') }}"  class="form-control @error('width') is-invalid @enderror" required>
                            @error('width')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="number_of_floors" class="form-label">عدد الادوار</label>
                            <input type="text" name="number_of_floors" placeholder="عدد الادوار" id="number_of_floors"
                            class="form-control @error('number_of_floors') is-invalid @enderror"   value="{{ old('number_of_floors', $project->number_of_floors ?? '') }}" required>
                            @error('number_of_floors')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="state" class="form-label">الدولة</label>
                            <input type="text" name="state" placeholder="الدولة" id="state"
                            class="form-control @error('state') is-invalid @enderror"   value="{{ old('state', $project->state ?? '') }}" required>
                            @error('state')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">مدينة</label>
                            <input type="text" name="city" placeholder="أدخل المدينة" id="city"
                            value="{{ old('city', $project->city ?? '') }}"  class="form-control @error('city') is-invalid @enderror" required>
                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="neighborhood" class="form-label">الحي</label>
                            <input type="text" name="neighborhood" placeholder="الحي" id="neighborhood"
                                class="form-control @error('neighborhood') is-invalid @enderror"
                                value="{{ old('neighborhood', $project->neighborhood ?? '') }}" required>
                            @error('neighborhood')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="street" class="form-label">الشارع</label>
                            <input type="text" name="street" placeholder="أدخل الشارع" id="street"
                            value="{{ old('street', $project->street ?? '') }}"  class="form-control @error('street') is-invalid @enderror" required>
                            @error('street')
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
</x-wahaj-layout>

