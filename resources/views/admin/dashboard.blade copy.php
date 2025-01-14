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
.hidden1 {
    display: none;
}

.btn-default {
    background-color: #007bff; /* Default active button color */
    color: #fff;
    border: 1px solid #007bff;
}

.btn-primary {
    background-color: #ced8e2; /* Inactive button color */
    color: #fff;
    border: 1px solid #007bff;
}

    </style>
  <div class="py-12 min-h-screen">
    <div class="flex justify-center my-6">
        <img src="{{ asset('logo1.png') }}" class="logo">
    </div>
    <div class="d-flex justify-content-end mb-3 px-4">
        <button class="btn btn-default table-btn" data-target="table-1">
            آمرتم
        </button>&nbsp;&nbsp;
        <button class="btn btn-primary table-btn" data-target="table-2">
            المواعيد
        </button>&nbsp;&nbsp;
        <button class="btn btn-primary table-btn" data-target="table-3">
            وهج وطن
        </button>&nbsp;&nbsp;
        <button class="btn btn-primary table-btn" data-target="table-4">
            تطبيق
        </button>
    </div>
    <div class="d-flex justify-content-end mb-3 px-4 newbtn" style="display: none;">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary ">
            <i class="fas fa-plus"></i> إضافة مشروع
        </a>
    </div>
    <div class="px-12">
        <div class="bg-light shadow-md rounded-lg overflow-hidden">
            <div class="p-12">
                <div class="rtl-container" style="direction: rtl;">
                    <div id="table-1" class="table-container">
                        <table class="table table-bordered table-blue">
                                <thead>
                                    <tr>
                                        <!--<th>القسم</th>-->
                                        <th>اسم الموظف</th>
                                        <th>اسم المنشأة</th>
                                        <th>الخدمة المطلوبة</th>
                                        {{-- <th>تاريخ البدء</th> --}}
                                        <!--<th>عدد الأيام لإكمال</th>-->
                                        <th> الجهة المقدمة للخدمة</th>
                                        <th>آخر تسجيل دخول</th>
                                        <th>حالة الوقت</th>
                                        <th>الحالة</th>
                                        {{-- <th>المستند</th> --}}
                                        <th>التقرير </th>
                                        <th>التعديل</th>
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
                                            <!--<td>{{ $types[$project->type] ?? 'غير محدد' }}</td>-->

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
                                                    <div><strong>عدد الأيام لإكمال :</strong>{{ $project->days }}</div>
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
                                            <!--<td>{{ $project->days }} يوم</td>-->
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
                                                    <span class="badge bg-success">في الوقت المحدد</span><br>
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

                                        </td> --}}
                                            <td>
                                                <form action="{{ route('admin.projects.saveReason') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                    <textarea name="reason" rows="2" cols="10" placeholder="أدخل السبب هنا"></textarea>
                                                    <button type="submit" class="btn btn-success">حفظ</button>

                                                </form>

                                            </td>
                                             <td><a target="_blank" href="{{ route('admin.projects.edit', $project->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit me-2"></i>&nbsp;التعديل
                                                </a></td>
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

                              <!-- Table 2 -->
                    <div id="table-2" class="table-container hidden">
                        <!-- Copy the same table structure as Table 1 -->
                        <table class="table table-bordered table-blue">
                            <thead>
                                <tr>
                                        <th>اسم صاحب الدعوة</th>
                                        <th>المناسبة </th>
                                        <th>اليوم</th>
                                        <th>التاريخ</th>
                                        <th>الوقت </th>
                                        <th>الدولة</th>
                                        <th>المدينة</th>
                                        <th>العنوان</th>
                                        <th>رابط الموقع</th>
                                        <th>صورة الدعوة</th>
                                        <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <span class="clickablemonasebat" onclick="toggleMonasebat()">
                                        </span>
                                        <div id="detailsmonasebat-1" class="detailsmonasebat hidden">
                                            <div><strong>الزواج</strong> </div>
                                            <div><strong>تكريم:</strong> </div>
                                            <div><strong>فعاليات:</strong> </div>
                                            <div><strong>مناسبات وطنية:</strong> </div>
                                            <div><strong>تدشين:</strong> </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span class="clickabletarekh" onclick="toggleDetails()">
                                        </span>
                                        <div id="detailstarekh-" class="detailstarekh hidden">
                                            <div><strong>تبرمج على ان يكون التاريخ الأ قرب</strong> </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Table 3 -->
                    <div id="table-3" class="table-container hidden">
                        <!-- Copy the same table structure as Table 1 -->
                        <table class="table table-bordered table-blue">
                            <!-- Same content as Table 1 -->
                            <thead>
                                <tr>
                                        <th>اسم الموظف</th>
                                        <th>المنشا</th>
                                        <th>الخدمة </th>
                                        <th>نوع العقار</th>
                                        <th>المساحة</th>
                                        <th>الطول </th>
                                        <th>العرض </th>
                                        <th>عند الادوار</th>
                                        <th>الدولة</th>
                                        <th>المدينة</th>
                                        <th>الحي</th>
                                        <th>الشارع</th>
                                        <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <span class="clickablemansha" onclick="toggleDetails()">
                                        </span>
                                        <div id="detailsmansha-" class="detailsmansha hidden">
                                            <div><strong>رقم السجل:</strong> </div>
                                            <div><strong> اسم المنشا:</strong> </div>
                                            <div><strong>رقم رخصة قال:</strong> </div>
                                            <div><strong>رقم الهاتف:</strong> </div>
                                            <div><strong>البلد:</strong> </div>
                                            <div><strong>الموقع:</strong></div>
                                            <div><strong>رقم الهاتف:</strong> </div>
                                            <div><strong>نوع النشاط التجاري:</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="clickablalkhidmat" onclick="toggleDetails()">

                                        </span>
                                        <div id="detailskhidmat-" class="detailsalkhidmat hidden">
                                            <div><strong>بيع</strong> </div>
                                            <div><strong>شراء:</strong> </div>
                                            <div><strong>استثمار:</strong> </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="clickablemansha" onclick="toggleDetails()">
                                        </span>
                                        <div id="detailsmansha-" class="detailsmansha hidden">
                                            <div><strong> ارض :</strong> </div>
                                            <div><strong>عمارة:</strong> </div>
                                            <div><strong>فله:</strong> </div>
                                            <div><strong>شقة:</strong> </div>
                                            <div><strong>فندق:</strong> </div>
                                            <div><strong>مول:</strong></div>
                                            <div><strong> ارض صناعية:</strong> </div>
                                            <div><strong>مستودعات تجارية:</strong> </div>
                                            <div><strong> محطات وقود</strong> </div>
                                            <div><strong>قصور:</strong> </div>
                                            <div><strong>مزارع:</strong> </div>
                                            <div><strong>مساحة متاحة الكتابة:</strong> </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Table 4 -->
                    <div id="table-4" class="table-container hidden">
                        <!-- Copy the same table structure as Table 1 -->
                        <table class="table table-bordered table-blue">
                            <!-- Same content as Table 1 -->
                            <thead>
                                <tr>
                                        <th>اسم الموظف cc</th>
                                        <th>اسم المنشأة</th>
                                        <th>الخدمة المطلوبة</th>
                                        <th> الجهة المقدمة  للخدمة</th>
                                        <th>آخر تسجيل دخول</th>
                                        <th>حالة الوقت</th>
                                        <th>الحالة</th>
                                        <th>التقرير </th>
                                        <th>التعديل</th>
                                        <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>


            function toggleDetails(id) {
                const details = document.getElementById('details-' + id);
                if (details.style.display === 'none' || details.style.display === '') {
                    details.style.display = 'block';
                } else {
                    details.style.display = 'none';
                }
            }

            function toggleMonasebat(id)
            {
                const details = document.getElementById('detailsmonasebat-' + id);
                if (details.style.display === 'none' || details.style.display === '') {
                    details.style.display = 'block';
                } else {
                    details.style.display = 'none';
                }
            }
            $(document).ready(function () {
    $('.table-btn').on('click', function (e) {
        e.preventDefault(); // Prevent default button behavior

        // Debug: Log the clicked button's text
        console.log('Button clicked:', $(this).text());

        // Remove 'btn-default' from all buttons and add 'btn-primary'
        $('.table-btn').removeClass('btn-default').addClass('btn-primary');

        // Add 'btn-default' to the clicked button and remove 'btn-primary'
        $(this).removeClass('btn-primary').addClass('btn-default');

        // Hide all table containers
        $('.table-container').addClass('hidden');

        // Show the targeted table container
        const targetId = $(this).data('target');
        console.log('Target table:', targetId);
        $('#' + targetId).removeClass('hidden');

        // Show or hide the .newbtn button based on the target table
        if (targetId === 'table-1') {
            $('.newbtn').show(); // Show the button for table-1
        } else {
            $('.newbtn').hide(); // Hide the button for other tables
        }
    });
});




        </script>

    </x-app-layout>
