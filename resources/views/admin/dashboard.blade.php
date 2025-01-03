<x-app-layout>
    <style>
    /* Ensure the table fits within the container and looks clean */
    .table {
        width: 100%;
        table-layout: auto; /* Let the table adjust based on content width */
        word-wrap: break-word; /* Allows long text to break into multiple lines */
        overflow-wrap: break-word; /* For better handling of long words */
    }

    /* Adjust column widths to prevent text overflow */
    .table th, .table td {
        text-align: center; /* Center align the text */
        vertical-align: middle; /* Vertically center content */
        padding: 10px; /* Add some padding for better spacing */
        white-space: normal; /* Allow wrapping of text in cells */
    }

    /* Specific column widths for better text distribution */
    .table th:nth-child(1), .table td:nth-child(1) {
        width: 10%; /* Section */
    }

    .table th:nth-child(2), .table td:nth-child(2) {
        width: 15%; /* Employee Name */
    }

    .table th:nth-child(3), .table td:nth-child(3) {
        width: 20%; /* Company Name */
    }

    .table th:nth-child(4), .table td:nth-child(4) {
        width: 15%; /* Service Required */
    }

    .table th:nth-child(5), .table td:nth-child(5) {
        width: 10%; /* Days to Complete */
    }

    .table th:nth-child(6), .table td:nth-child(6) {
        width: 15%; /* Service Provider */
    }

    .table th:nth-child(7), .table td:nth-child(7) {
        width: 15%; /* Last Login */
    }

    .table th:nth-child(8), .table td:nth-child(8) {
        width: 10%; /* Time Status */
    }

    .table th:nth-child(9), .table td:nth-child(9) {
        width: 10%; /* Status */
    }

    .table th:nth-child(10), .table td:nth-child(10) {
        width: 15%; /* Report */
    }

    .table th:nth-child(11), .table td:nth-child(11) {
        width: 15%; /* Actions */
    }

    /* Adjust button width and icon spacing */
    /* Ensure the button content (icon and text) are aligned in one line */
    .btn {
        display: inline-flex; /* Align text and icon horizontally */
        align-items: center;  /* Vertically center the text and icon */
        justify-content: center;
        padding: 6px 12px; /* Adjust padding for the button */
        font-size: 14px; /* Ensure proper font size */
    }

    .btn i {
        margin-right: 5px; /* Space between the icon and the text */
    }

    /* If the text still overflows or breaks, we can limit the button width */
    .btn-danger {
        white-space: nowrap; /* Prevent text from wrapping */
    }


    /* Responsive table */
    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 12px; /* Reduce font size on smaller screens */
            padding: 8px; /* Reduce padding on smaller screens */
        }

        /* Stack buttons vertically on small screens */
        .btn {
            flex-direction: column;
        }
    }
    /* Ensures the badge and date are displayed in a single line */
td .badge {
    display: inline-block;
    vertical-align: middle; /* Aligns the badge and text vertically */
}

td .date-text {
    display: inline-block;
    margin-left: 5px; /* Adds space between the badge and the date */
    vertical-align: middle; /* Aligns the text with the badge */
    font-size: 0.875rem; /* Adjusts font size for better readability */
}

    </style>
        <div class="py-12 min-h-screen ">
            <div class="flex justify-center my-6">
                <img src="{{ asset('logo1.png') }}" class="logo">
            </div>
            <div class="d-flex justify-content-end mb-3 px-4">
                <a href="{{ route('admin.projects.create') }}" target="_blank" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة مشروع
                </a>
            </div>
            <div class="px-12">
                <div class="bg-light shadow-md rounded-lg overflow-hidden">
                    <div class="p-12">
                        <div class="rtl-container" style="direction: rtl;">
                            <table class="table table-bordered table-blue">
                                <thead>
                                    <tr>
                                        <th>القسم</th>
                                        <th>اسم الموظف</th>
                                        <th>اسم المنشأة</th>
                                        <th>الخدمة المطلوبة</th>
                                        {{-- <th>تاريخ البدء</th> --}}
                                        <th>عدد الأيام لإكمال</th>
                                        <th> الجهة المقدمة للخدمة</th>
                                        <th>آخر تسجيل دخول</th>
                                        <th>حالة الوقت</th>
                                        <th>الحالة</th>
                                        {{-- <th>المستند</th> --}}
                                        <th>التقرير </th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        @php
                                            $serviceTypes = [
                                                'issuing_license' => 'إصدار رخصة',
                                                'foreign_investment' => 'الاستثمار الأجنبي',
                                                'issuing_trade_mark' => 'إصدار علامة تجارية',
                                            ];
                                            $types = [
                                                'amirtam_khedmat' => 'آمر تم لخدمات الأعمال',
                                                'wahaj_watan' => 'وهج وطن العقارية',
                                                'alhojamat' => 'منصة الجامعات',
                                            ];
                                            $endDate = \Carbon\Carbon::parse($project->start_date)->addDays(
                                                (int) $project->days,
                                            );
                                            $isOverdue = \Carbon\Carbon::now()->gt($endDate);

                                        @endphp
                                        <tr>
                                            <td>{{ $types[$project->type] ?? 'غير محدد' }}</td>

                                            <td>
                                                @if ($project->employee)
                                                    <a target="_blank"
                                                        href="{{ url('admin/view-projects/' . $project->employee->id) }}">
                                                        {{ $project->employee->name }}
                                                    </a>
                                                @else
                                                    غير متوفر
                                                @endif
                                            </td>

                                            <td>
                                                <span class="clickable" onclick="toggleDetails({{ $project->id }})">
                                                    {{ $project->company_name }}
                                                </span>
                                                <div id="details-{{ $project->id }}" class="details hidden">
                                                    <div><strong>اسم الشركة:</strong> {{ $project->company_name }}</div>
                                                    <div><strong>السجل التجاري:</strong> {{ $project->commertial_register }}
                                                    </div>
                                                    <div><strong> تاريخ البدء:</strong> {{ $project->start_date }}</div>
                                                    <div><strong>البريد الإلكتروني:</strong> <a
                                                            href="mailto:{{ $project->email }}">{{ $project->email }}</a>
                                                    </div>
                                                    <div><strong>البلد:</strong> {{ $project->country }}</div>
                                                    <div><strong>مدينة:</strong> {{ $project->city }}</div>
                                                    <div><strong>رقم الهاتف:</strong> {{ $project->person_contact }}</div>
                                                    <div><strong>نوع النشاط التجاري:</strong> {{ $project->business_type }}
                                                    </div>
                                                    <div><strong>المستند :</strong>
                                                        <a href="{{ asset($project->document) }}" target="_blank" download
                                                            class="btn btn-primary btn-sm">
                                                            تنزيل
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $project->service_required }}</td>
                                            {{-- <td>{{ $project->start_date }}</td> --}}
                                            <td>{{ $project->days }} يوم</td>
                                            <td>{{ $serviceTypes[$project->service_type] ?? 'غير محدد' }}</td>
                                            <td>
                                                @if ($project->employee && $project->employee->last_login)
                                                    {{ \Carbon\Carbon::parse($project->employee->last_login)->format('Y-m-d H:i:s') }}
                                                @else
                                                    لم يتم تسجيل الدخول
                                                @endif
                                            </td>
                                            <td> <!-- New Column -->
                                                @if ($isOverdue)
                                                    <span class="badge bg-danger">انتهى الوقت</span>
                                                    <small class="date-text">انتهى في: {{ $endDate->format('Y-m-d') }}</small>
                                                @else
                                                    <span class="badge bg-success">في الوقت المحدد</span>
                                                    <small class="date-text">ينتهي في: {{ $endDate->format('Y-m-d') }}</small>
                                                @endif
                                            </td>

                                            <td>
                                                <span
                                                    class="badge {{ $project->status == 'started' ? 'bg-danger' : ($project->status == 'in_progress' ? 'bg-warning' : 'bg-success') }}">
                                                    {{ $project->status == 'started' ? 'تم البدء' : ($project->status == 'in_progress' ? 'قيد التنفيذ' : 'مكتمل') }}
                                                </span>
                                            </td>
                                            {{-- <td>
                                            <a href="{{ asset($project->document) }}" target="_blank" download class="btn btn-primary btn-sm">
                                                تنزيل
                                            </a>
                                        </td> --}}
                                            <td>
                                                <a target="_blank" href="{{ route('admin.projects.edit', $project->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit me-2"></i>&nbsp;التعديل
                                                </a>
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.projects.destroy', $project->id) }}"
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





        <script>
            function toggleDetails(id) {
                const details = document.getElementById('details-' + id);
                if (details.style.display === 'none' || details.style.display === '') {
                    details.style.display = 'block';
                } else {
                    details.style.display = 'none';
                }
            }
        </script>
    </x-app-layout>
