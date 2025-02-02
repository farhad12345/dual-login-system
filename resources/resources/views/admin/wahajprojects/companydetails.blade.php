<x-app-layout>
    <style>
        .rtl-container {
    direction: rtl;
    text-align: right;
}

    </style>
    <div class="py-12 bg-blue-100 min-h-screen" style="background-color:#F5F5DC">
        <div class="flex justify-center my-6">
            <img src="{{ asset('logo1.png') }}" class="logo">
        </div>
    <div class="px-4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="rtl-container" style="direction: rtl;">
                        <table class="table table-bordered w-full min-w-full border-collapse bg-blue-50 text-right rounded-lg">
                            <thead class="bg-blue-600 text-white">
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
                                        <td>{{ $project->days }}</td>
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
