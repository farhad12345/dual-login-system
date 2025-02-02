<x-app-layout>
    @section('title', 'Dashboard')
    <style>
        .rtl-container {
            direction: rtl;
            text-align: right;
        }
        /* Small devices (phones, < 576px) */
@media (max-width: 575.98px) {
    .logo {
        max-height: 180px; /* Smaller logo for small screens */
        position: relative;
        margin-top: -50px;
    }

    .addbutton, .table-btn {
        font-size: 12px;
        padding: 6px 12px;
        width: 100%; /* Buttons stack and fill width */
    }

    .d-flex {
        flex-direction: column; /* Stack buttons vertically */
        align-items: stretch;
    }
    #addbutton {
        font-size: 16px;
        padding: 4px 8px;
    }
    .mb-4 {
        margin-bottom: 20px;
    }
}

/* Medium devices (tablets, 576px to 768px) */
@media (min-width: 576px) and (max-width: 767.98px) {
    .logo {
        max-height: 100px;
    }

    .addbutton, .table-btn {
        font-size: 14px;
        padding: 8px 14px;
    }

    .d-flex {
        flex-wrap: wrap; /* Allow buttons to wrap */
        justify-content: center; /* Center align buttons */
    }

    .px-4 {
        padding-left: 10px;
        padding-right: 10px;
    }
}

/* Large devices (desktops, 768px and above) */
@media (min-width: 768px) {


    .addbutton, .table-btn {
        font-size: 11px;
        padding: 7px 12px;
    }

    .d-flex {
        flex-wrap: nowrap; /* Prevent wrapping on larger screens */
        justify-content: flex-end; /* Right-align buttons */
    }

    .px-4 {
        padding-left: 20px;
        padding-right: 20px;
    }
}
/* Responsive Media Queries */

/* For tablets and small screens (width 768px and below) */
@media (max-width: 768px) {
    .rtl-container table {
        font-size: 0.85rem; /* Reduce font size for table content */
    }

    .rtl-container th, .rtl-container td {
        padding: 0.5rem; /* Reduce padding for table cells */
        white-space: nowrap; /* Prevent text wrapping */
    }

    .rtl-container thead {
        display: none; /* Hide table headers for small screens */
    }

    .rtl-container tbody tr {
        display: flex;
        flex-direction: column;
        border-bottom: 1px solid #ddd;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
    }

    .rtl-container tbody td {
        display: flex;
        /*justify-content: space-between;*/
        align-items: center;
        padding: 0.5rem 0;
    }

    .rtl-container tbody td::before {
        content: attr(data-label);
        font-weight: bold;
        margin-right: 1rem;
        text-align: left;
    }

    .mt-4 {
        text-align: center;
    }
}

/* For mobile screens (width 480px and below) */
@media (max-width: 480px) {
    .rtl-container table {
        font-size: 0.75rem; /* Further reduce font size for mobile */
    }

    .rtl-container tbody tr {
        border-bottom: 1px solid #ccc;
        padding-bottom: 0.8rem;
    }

    .rtl-container tbody td {
        flex-wrap: wrap;
        padding: 0.4rem 0;
    }

    .rtl-container tbody td::before {
        font-size: 0.8rem; /* Smaller label text */
    }
}

    </style>
    <div class="min-h-screen py-12 bg-blue-100 back" >
        <div class="flex justify-center my-6">
            <img src="{{ asset('logo1.png') }}" class="logo">
        </div>

        {{-- <h2 class="px-4 mb-4 text-lg font-semibold text-right text-blue-700">{{ __('قائمة المشاريع') }}</h2> --}}
        <div class="px-4 mb-3 d-flex justify-content-end">
            <a href="{{ route('projects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة مشروع
            </a>&nbsp;&nbsp;
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة مؤسسة
            </a>&nbsp;&nbsp;
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة فرد
            </a>&nbsp;&nbsp;
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus"></i>إضافة لهيئة أو سفارة
            </a>
        </div>


        <!-- Card Container -->
        <div class="px-4">
            <div class="overflow-hidden rounded-lg shadow-md" style="background-color:white">
                <div class="p-6">
                    <div class="rtl-container" style="direction: rtl;">
                        <table class="table align-middle table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>اسم الشركة</th>
                                    <th>الخدمة المطلوبة</th>
                                    <th>تاريخ البدء</th>
                                    <th>عدد الأيام لإكمال</th>
                                    {{-- <th>الأيام المتبقية</th> --}}
                                    <th>اسم الشخص</th>
                                    <th>رقم التواصل</th>
                                    <th>نوع الخدمة</th>
                                    <th>المدينة</th>
                                    <th>السجل التجاري</th>
                                    <th>الحالة</th>
                                    <th>السبب</th>

                                    <th>المستند</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td data-label=": اسم الشركة">{{ $project->company_name }}</td>
                                        <td data-label="الخدمة المطلوبة">{{ $project->service_required }}</td>
                                        <td data-label="تاريخ البدء">{{ $project->start_date }}</td>
                                        <td data-label="عدد الأيام لإكمال">يوم {{ $project->days }}</td>
                                        {{-- <td>
                                    @php
                                        $currentDate = \Carbon\Carbon::now(); // Current date
                                        $endDate = \Carbon\Carbon::parse($project->completion_date);
                                        $daysToComplete = $endDate->diffInDays($currentDate, false); // Calculate remaining days
                                        $daysToComplete = floor($daysToComplete); // Remove decimal part
                                    @endphp
                                    @if ($daysToComplete > 0)
                                        {{ $daysToComplete }} الأيام المتبقية لإكمال المهمة
                                    @elseif ($daysToComplete == 0)
                                        {{ __('اليوم هو آخر موعد لإكمال المهمة') }}
                                    @else
                                        {{ abs($daysToComplete) }} الأيام المتأخرة
                                    @endif
                                </td> --}}

                                        <td data-label="اسم الشخص">{{ $project->person_name }}</td>
                                        <td data-label=" رقم التواصل">{{ $project->person_contact }}</td>
                                        @php
                                        $serviceTypes = [
                                            'issuing_license' => 'إصدار رخصة',
                                            'foreign_investment' => 'الاستثمار الأجنبي',
                                            'issuing_trade_mark' => 'إصدار علامة تجارية',
                                        ];
                                    @endphp
                                        <td data-label="نوع الخدمة">{{ $serviceTypes[$project->service_type] ?? 'غير محدد' }}</td>

                                        <td data-label=" المدينة">{{ $project->city }}</td>
                                        <td data-label="السجل التجاري">{{ $project->commertial_register }}</td>
                                        <td data-label="الحالة">
                                            <span
                                                class="badge {{ $project->status == 'started' ? 'bg-danger' : ($project->status == 'in_progress' ? 'bg-warning' : 'bg-success') }}">
                                                {{ $project->status == 'started' ? 'تم البدء' : ($project->status == 'in_progress' ? 'قيد التنفيذ' : 'مكتمل') }}
                                            </span>
                                        </td>
                                        <td data-label="السبب"><span style="color:red">{{ $project->reason ?? '' }}</span></td>

                                        <td data-label="المستند">
                                            <a href="{{ asset($project->document) }}" target="_blank"
                                                class="text-blue-500 hover:underline">عرض</a>
                                        </td>
                                        <td data-label="الإجراءات">
                                            <a href="{{ route('projects.edit', $project->id) }}"
                                                class="text-white btn btn-warning btn-sm">تعديل</a>
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white btn btn-danger btn-sm">حذف</button>
                                            </form>

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

</x-app-layout>
