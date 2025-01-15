<x-wahaj-layout>
    <style>
        .rtl-container {
            direction: rtl;
            text-align: right;
        }
    </style>
    <div class="py-12 bg-blue-100 min-h-screen back">
        <div class="flex justify-center my-6">
            <img src="{{ asset('logo1.png') }}" class="logo">
        </div>

        {{-- <h2 class="text-lg font-semibold mb-4 text-right text-blue-700 px-4">{{ __('قائمة المشاريع') }}</h2> --}}
        <div class="d-flex justify-content-end mb-3 px-4">
            <a href="{{ route('almawayeed.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة مشروع
            </a>
        </div>

        <!-- Card Container -->
        <div class="px-4">
            <div class="shadow-md rounded-lg overflow-hidden" style="background-color:white">
                <div class="p-6">
                    <div class="rtl-container" style="direction: rtl;">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <!--<th>القسم</th>-->
                                    <th> اسم صاحب الدعوة</th>
                                    <th>المناسبة</th>
                                    <th>اليوم</th>
                                    <th>التاريخ</th>
                                    <th>الوقت</th>
                                    {{-- <th>الدولة</th> --}}
                                    <th>المدينة</th>
                                    <th>العنوان </th>
                                    <th>رابط الموقع</th>
                                    <th>صورة الدعوة</th>
                                    <th>التعديل</th>

                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $mawayeedproject)
                                    @php
                                        $types = [
                                            'marriage' => 'الزواج',
                                            'honoring' => 'تكريم',
                                            'events' => 'فعاليات',
                                            'national_occasions' => 'مناسبات وطنية',
                                            'launching' => 'تدشين',
                                        ];

                                    @endphp
                                    <tr>

                                        <td>{{ $mawayeedproject->invitation_name }}</td>


                                        <td>{{ $types[$mawayeedproject->occasion] ?? 'غير محدد' }}</td>
                                        <td>{{ $mawayeedproject->day }}</td>
                                        <td>{{ $mawayeedproject->date }}</td>
                                        <td>{{ $mawayeedproject->time }}</td>

                                        {{-- <td>{{ $mawayeedproject->state }}</td> --}}
                                        <td>{{ $mawayeedproject->city }}</td>
                                        <td>{{ $mawayeedproject->address }}</td>
                                        <td><a href="{{ $mawayeedproject->link }}"><u>Link</u></a></td>
                                        <td>
                                            @if ($mawayeedproject->image)
                                                <img src="{{ asset($mawayeedproject->image) }}" alt="Project Image"
                                                    style="width: 100px; height: auto;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <span
                                                class="badge {{ $mawayeedproject->status == 'started' ? 'bg-danger' : ($mawayeedproject->status == 'in_progress' ? 'bg-warning' : 'bg-success') }}">
                                                {{ $mawayeedproject->status == 'started' ? 'تم البدء' : ($mawayeedproject->status == 'in_progress' ? 'قيد التنفيذ' : 'مكتمل') }}
                                            </span>
                                        </td> --}}
                                        <td><a target="_blank"
                                                href="{{ route('almawayeed.edit', $mawayeedproject->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-2"></i>&nbsp;التعديل
                                            </a></td>
                                        <td>
                                            <a href="{{ route('almawayeed.destroy', $mawayeedproject->id) }}"
                                                onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt me-2"></i> &nbsp; حذف المشروع
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="mt-4">
                            {{ $projects->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>


</x-wahaj-layout>
