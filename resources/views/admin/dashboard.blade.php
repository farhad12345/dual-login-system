<x-app-layout>
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

    </style>
    <div class="py-12 min-h-screen" style="background-color:#F0F8FF;">
        <div class="flex justify-center my-6">
            <img src="{{ asset('logo1.png') }}" class="logo">
        </div>
        <div class="d-flex justify-content-end mb-3 px-4">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة مشروع
            </a>
        </div>
        <div class="px-4">
            <div class="bg-light shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="rtl-container" style="direction: rtl;">
                        <table class="table table-bordered table-blue">
                            <thead>
                                <tr>
                                    <th>اسم الموظف</th>
                                    <th>اسم المنشأة</th>
                                    <th>الخدمة المطلوبة</th>
                                    <th>تاريخ البدء</th>
                                    <th>عدد الأيام لإكمال</th>
                                    <th>نوع الخدمة</th>
                                    <th>آخر تسجيل دخول</th>
                                    <th>الحالة</th>
                                    <th>المستند</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                <tr>
                                    <td>
                                        @if ($project->employee)
                                        <a href="{{ url('admin/view-projects/' . $project->employee->id) }}">
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
                                            <div><strong>السجل التجاري:</strong> {{ $project->commertial_register }}</div>
                                            <div><strong>البريد الإلكتروني:</strong> <a href="mailto:{{ $project->email }}">{{ $project->email }}</a></div>
                                            <div><strong>البلد:</strong> {{ $project->country }}</div>
                                            <div><strong>مدينة:</strong> {{ $project->city }}</div>
                                            <div><strong>رقم الهاتف:</strong> {{ $project->person_contact }}</div>
                                            <div><strong>نوع النشاط التجاري:</strong> {{ $project->business_type }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $project->service_required }}</td>
                                    <td>{{ $project->start_date }}</td>
                                    <td>{{ $project->days }} يوم</td>
                                    <td>{{ $project->service_type }}</td>
                                    <td>
                                        @if ($project->employee && $project->employee->last_login)
                                            {{ \Carbon\Carbon::parse($project->employee->last_login)->format('Y-m-d H:i:s') }}
                                        @else
                                            لم يتم تسجيل الدخول
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $project->status == 'started' ? 'bg-danger' : ($project->status == 'in_progress' ? 'bg-warning' : 'bg-success') }}">
                                            {{
                                                $project->status == 'started' ? 'تم البدء' :
                                                ($project->status == 'in_progress' ? 'قيد التنفيذ' : 'مكتمل')
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ asset($project->document) }}" target="_blank" download class="btn btn-primary btn-sm">
                                            تنزيل
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                        <a href="{{ route('admin.projects.destroy', $project->id) }}"
                                           onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')"
                                           class="btn btn-danger btn-sm">
                                            حذف
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



