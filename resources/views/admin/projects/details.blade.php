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

                    <div class="rtl-container" style="direction: rtl;">
                        <table class="table table-bordered table-blue">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th>اسم الشركة</th>
                                    <th>الخدمة المطلوبة</th>
                                    <th>تاريخ البدء</th>
                                    {{-- <th>تاريخ الإكمال</th> --}}
                                    <th>اسم الشخص</th>
                                    <th>رقم التواصل</th>
                                    <th>نوع الخدمة</th>
                                    <th>المدينة</th>
                                    <th>السجل التجاري</th>
                                    <th>الحالة</th>
                                    <th>المستند</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project->company_name }}</td>
                                        <td>{{ $project->service_required }}</td>
                                        <td>{{ $project->start_date }}</td>
                                        {{-- <td>{{ $project->completion_date }}</td> --}}
                                        <td>{{ $project->person_name }}</td>
                                        <td>{{ $project->person_contact }}</td>
                                        <td>{{ $project->service_type }}</td>
                                        <td>{{ $project->city }}</td>
                                        <td>{{ $project->commertial_register }}</td>
                                        <td>
                                            <span class="badge {{ $project->status == 'started' ? 'bg-danger' : ($project->status == 'in_progress' ? 'bg-warning' : 'bg-success') }}">
                                                {{
                                                    $project->status == 'started' ? 'تم البدء' :
                                                    ($project->status == 'in_progress' ? 'قيد التنفيذ' : 'مكتمل')
                                                }}
                                            </span>
                                        </td>


                                        {{-- <td>
                                            <span class="badge
                                                {{ $project->status == 'started' ? 'bg-red-500' : ($project->status == 'in_progress' ? 'bg-yellow-500' : 'bg-green-500') }}">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </td> --}}
                                        <td>
                                            <a href="{{ asset($project->document) }}" target="_blank" class="text-blue-500 hover:underline">عرض</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning btn-sm text-white">تعديل</a>
                                            <a href="{{ route('admin.projects.destroy', $project->id) }}"
                                               onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')"
                                               class="btn btn-danger btn-sm text-white d-inline">
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

</x-app-layout>
