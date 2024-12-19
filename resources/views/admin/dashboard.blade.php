<x-app-layout>
    <style>
        .rtl-container {
    direction: rtl;
    text-align: right;
}

    .details {
        display: none;
        margin-top: 5px;
        background-color: #f9f9f9;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .clickable {
        color: blue;
        cursor: pointer;
        text-decoration: underline;
    }


    </style>
<div class="py-12 bg-blue-100 min-h-screen" style="background-color:#F5F5DC  ">
    {{-- <h2 class="text-lg font-semibold mb-4 text-right text-blue-700 px-4">{{ __('قائمة المشاريع') }}</h2> --}}
    <div class="flex justify-center my-6">
        <img src="{{ asset('logo1.png') }}" class="logo">
    </div>
    <div class="d-flex justify-content-end mb-3 px-4">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إضافة مشروع
        </a>
    </div>

    <!-- Card Container -->
    <div class="px-4">
        <div class="bg-dark-gray shadow-md rounded-lg overflow-hidden" style="background-color: burlywood">
            <div class="p-6">
                <div class="rtl-container" style="direction: rtl;">
                    <table class="table table-bordered w-full min-w-full border-collapse bg-blue-50 text-right rounded-lg">
                        <thead class="bg-blue-600 text-black">
                            <tr>
                                <th style="white-space: nowrap;">اسم الموظف</th>
                                <th style="white-space: nowrap;"> اسم المنشأة</th>
                                <th style="white-space: nowrap;">الخدمة المطلوبة</th>
                                <th style="white-space: nowrap;">تاريخ البدء</th>
                                <th style="white-space: nowrap;"> عدد الأيام لإكمال</th>
                                {{-- <th style="white-space: nowrap;">تاريخ الإكمال</th> --}}
                                <th style="white-space: nowrap;">نوع الخدمة</th>
                                {{-- <th style="white-space: nowrap;">المدينة</th> --}}
                                {{-- <th style="white-space: nowrap;">السجل التجاري</th> --}}
                                <th style="white-space: nowrap;">آخر تسجيل دخول</th>
                                <th style="white-space: nowrap;">الحالة</th>
                                <th style="white-space: nowrap;">المستند</th>
                                <th style="white-space: nowrap;">الإجراءات</th>
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
                                        {{-- <div><strong>عدد الأيام لإكمال:</strong> {{ $project->days }}</div> --}}
                                    </div>
                                </td>

                                {{-- <td>
                                    @if ($project->employee)
                                        <a href="{{ url('admin/company-details/' . $project->employee->id) }}">
                                            {{ $project->company_name }}
                                        </a>
                                    @else
                                        غير متوفر
                                    @endif
                                </td> --}}

                                <td>{{ $project->service_required }}</td>
                                <td>{{ $project->start_date }}</td>
                                <td>{{ $project->days }} يوم</td>


                                <td>{{ $project->service_type }}</td>
                                {{-- <td>{{ $project->city }}</td> --}}

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
                                <a href="{{ asset($project->document) }}" target="_blank" download class="btn btn-primary btn-sm d-inline">
                                تنزيل
                                </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                    <a href="{{ route('admin.projects.destroy', $project->id) }}"
                                       onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')"
                                       class="btn btn-danger btn-sm d-inline">
                                        حذف
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
