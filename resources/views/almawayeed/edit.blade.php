<x-wahaj-layout>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center">تعديل المشروع</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('almawayeed.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $emp_id }}" name="employee_id">

                    <div class="row mb-3">
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

                        <div class="col-md-6">
                            <label for="occasion" class="form-label">المناسبة</label>
                            <select name="occasion" id="occasion" class="form-control @error('occasion') is-invalid @enderror">
                                <option value="">Select</option>
                                <option value="marriage" {{ old('occasion', $project->occasion) == 'marriage' ? 'selected' : '' }}>الزواج</option>
                                <option value="honoring" {{ old('occasion', $project->occasion) == 'honoring' ? 'selected' : '' }}>تكريم</option>
                                <option value="events" {{ old('occasion', $project->occasion) == 'events' ? 'selected' : '' }}>فعاليات</option>
                                <option value="national_occasions" {{ old('occasion', $project->occasion) == 'national_occasions' ? 'selected' : '' }}>مناسبات وطنية</option>
                                <option value="launching" {{ old('occasion', $project->occasion) == 'launching' ? 'selected' : '' }}>تدشين</option>
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
                            <label for="day" class="form-label">اليوم</label>
                            <input type="text" name="day" placeholder="اليوم" id="day"
                                class="form-control @error('day') is-invalid @enderror" value="{{ old('day', $project->day ?? '') }}" required>
                            @error('day')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="date" class="form-label">التاريخ</label>
                            <input type="text" placeholder="التاريخ" name="date" id="date"
                                class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $project->date ?? '') }}" >
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="time" class="form-label">الوقت</label>
                            <input type="time" name="time" placeholder="الوقت" id="time"
                                class="form-control @error('time') is-invalid @enderror" value="{{ old('time', $project->time ?? '') }}" required>
                            @error('time')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="state" class="form-label">الدولة</label>
                            <input type="text" name="state" placeholder="الدولة" id="state"
                                class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $project->state ?? '') }}" required>
                            @error('state')
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
                                class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $project->city ?? '') }}">
                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">العنوان</label>
                            <input type="text" name="address" placeholder="العنوان" id="address"
                                class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $project->address ?? '') }}">
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="link" class="form-label">رابط الموقع</label>
                            <input type="text" name="link" placeholder="رابط الموقع" id="link"
                                class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $project->link ?? '') }}">
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">صورة الدعوة</label>
                            <input type="file" name="image" placeholder="صورة الدعوة" id="image"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        $(document).ready(function () {
            // Initialize the datepicker
            $('#date').datepicker({
                dateFormat: 'dd-mm-yy', // Change the format as needed
                changeMonth: true,
                changeYear: true,
                yearRange: "1900:2100"
            });
        });
    </script>
</x-wahaj-layout>
