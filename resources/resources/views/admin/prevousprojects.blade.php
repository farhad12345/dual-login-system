<x-app-layout>
    @section('title', 'Details')
    <style>
        .table-blue th {
            background-color: #003366 !important;
            color: white !important;
        }
        .table-blue td {

            color: black !important;
        }
        .table-blue th {

        color: black !important;
        }
        .table-blue tbody tr:nth-child(even) {
            background-color: #E6F7FF !important;
        }
        .table-blue tbody tr:nth-child(odd) {
            background-color: #CCEBFF !important;
        }
        .table-blue td, .table-blue th {
            border-color: #003366 !important;
        }
        .btn-primary {
            background-color: #0066CC !important;
            border-color: #0066CC !important;
        }
        .btn-primary:hover {
            background-color: #0052A3 !important;
            border-color: #0052A3 !important;
        }
        .btn-warning {
            background-color: #FFCC00 !important;
            border-color: #FFCC00 !important;
        }
        .btn-danger {
            background-color: #FF3300 !important;
            border-color: #FF3300 !important;
        }
        .rtl-container {
    direction: rtl;
    text-align: right;
        }
        .table>:not(caption)>*>*:nth-child(even),
        .table tbody tr:nth-child(even) {
            background-color: #F0F8FF !important; /* Alice Blue */
            color: #003366; /* Navy Text */
        }

        .table>:not(caption)>*>*:nth-child(odd),
        .table tbody tr:nth-child(odd) {
            background-color: #DDEEFF !important; /* Light Steel Blue */
            color: #003366; /* Navy Text */
        }

        .table>:not(caption)>*>* th {
            background-color: #003366 !important; /* Navy */
            color: #FFFFFF !important; /* White Text */
            border: 1px solid #003366 !important;
        }
        .back1 {
        background-image: url('{{ asset('admin/ff1.jpg') }}');
        background-repeat: no-repeat;
        background-size: cover;
    }


    </style>

   <div class="py-12 min-h-screen back1" >

    <div class="flex justify-center my-6">
        <img src="{{ asset('logo1.png') }}" class="logo">
    </div>
    <br><br>
    <div class="px-4">

        <div class="bg-light shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-4 text-right text-blue-700">{{ __('قائمة المشاريع') }}</h2>

                    @if (session('success'))
                        <div class="alert alert-success mb-4 bg-green-100 text-green-800 p-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{-- <a href="{{ route('projects.downloadPdf') }}" class="btn btn-primary">تحميل تقرير PDF</a> --}}
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
                                                    style="width: 100px; height: 65px;">
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
                                        <td>
                                            <a href="{{ route('admin.almawayeed.edit', $mawayeedproject->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-2"></i>&nbsp;التعديل
                                            </a></td>
                                        <td>
                                            <a href="{{ route('admin.almawayeed.destroy', $mawayeedproject->id) }}"
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
    </div>
</div>

</x-app-layout>
