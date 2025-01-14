<x-app-layout>
    <style>
        .back1{
        background-image: url('ff1.jpg');
        background-repeat: no-repeat;
        background-size: cover

    }
    </style>
    <div class="container mt-5 back1">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center">تعديل المشروع</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.almawayeed.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Add PUT method for updating -->
                    <input type="hidden" value="{{ auth()->user()->id }}" name="employee_id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="employee_id" class="form-label">الموظف</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('employee_id', $project->employee_id ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="invitation_name" class="form-label">اسم صاحب الدعوة</label>
                            <input type="text" name="invitation_name" placeholder="أدخل اسم صاحب الدعوة" id="invitation_name"
                                class="form-control @error('invitation_name') is-invalid @enderror"
                                value="{{ old('invitation_name', $project->invitation_name ?? '') }}" required>
                            @error('invitation_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="day" class="form-label">اليوم</label>
                            <input type="text" name="day" placeholder="اليوم" id="day"
                                class="form-control @error('day') is-invalid @enderror"
                                value="{{ old('day', $project->day ?? '') }}" required>
                            @error('day')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="occasion" class="form-label">المناسبة</label>
                            <select name="occasion" id="occasion" class="form-control @error('occasion') is-invalid @enderror">
                                <option value="">Select</option>
                                <option value="marriage" {{ old('occasion', $project->occasion ?? '') == 'marriage' ? 'selected' : '' }}>الزواج</option>
                                <option value="honoring" {{ old('occasion', $project->occasion ?? '') == 'honoring' ? 'selected' : '' }}>تكريم</option>
                                <option value="events" {{ old('occasion', $project->occasion ?? '') == 'events' ? 'selected' : '' }}>فعاليات</option>
                                <option value="national_occasions" {{ old('occasion', $project->occasion ?? '') == 'national_occasions' ? 'selected' : '' }}>مناسبات وطنية</option>
                                <option value="launching" {{ old('occasion', $project->occasion ?? '') == 'launching' ? 'selected' : '' }}>تدشين</option>
                            </select>
                            @error('occasion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="time" class="form-label">الوقت</label>
                            <input type="text" name="time" placeholder="الوقت" id="time"
                                class="form-control @error('time') is-invalid @enderror"
                                value="{{ old('time', $project->time ?? '') }}" required>
                            @error('time')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="date" class="form-label">التاريخ</label>
                            <input type="date" placeholder="التاريخ" name="date" id="date"
                                class="form-control @error('date') is-invalid @enderror"
                                value="{{ old('date', $project->date ?? '') }}" required>
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="city" class="form-label">المدينة</label>
                            <input type="text" name="city" placeholder="المدينة" id="city"
                                class="form-control @error('city') is-invalid @enderror"
                                value="{{ old('city', $project->city ?? '') }}" required>
                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="state" class="form-label">الدولة</label>
                            <input type="text" name="state" placeholder="الدولة" id="state"
                                class="form-control @error('state') is-invalid @enderror"
                                value="{{ old('state', $project->state ?? '') }}" required>
                            @error('state')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="address" class="form-label">العنوان</label>
                            <input type="text" name="address" placeholder="العنوان" id="address"
                                class="form-control @error('address') is-invalid @enderror"
                                value="{{ old('address', $project->address ?? '') }}" required>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="link" class="form-label">رابط الموقع</label>
                            <input type="text" name="link" placeholder="رابط الموقع" id="link"
                                class="form-control @error('link') is-invalid @enderror"
                                value="{{ old('link', $project->link ?? '') }}" required>
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="image" class="form-label">صورة الدعوة</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @if ($project->image ?? false)
                                <img src="{{ asset('path/to/images/' . $project->image) }}" alt="صورة الدعوة" class="mt-2" style="max-width: 100px;">
                            @endif
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
