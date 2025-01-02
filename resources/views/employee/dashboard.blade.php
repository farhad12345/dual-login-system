<x-app-layout>
    <style>
        .rtl-container {
            direction: rtl;
            text-align: right;
        }
    </style>
    <div class="py-12 bg-blue-100 min-h-screen back" >
        <div class="flex justify-center my-6">
            <img src="{{ asset('logo1.png') }}" class="logo">
        </div>
        {{-- <h2 class="text-lg font-semibold mb-4 text-right text-blue-700 px-4">{{ __('قائمة المشاريع') }}</h2> --}}
        <div class="d-flex justify-content-end mb-3 px-4">
            <a href="{{ route('projects.create') }}" class="btn btn-primary">
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
                                        <td>يوم {{ $project->days }}</td>
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
                                        @php
                                        $serviceTypes = [
                                            'issuing_license' => 'إصدار رخصة',
                                            'foreign_investment' => 'الاستثمار الأجنبي',
                                            'issuing_trade_mark' => 'إصدار علامة تجارية',
                                        ];
                                    @endphp
                                        <td>{{ $serviceTypes[$project->service_type] ?? 'غير محدد' }}</td>

                                        <td>{{ $project->city }}</td>
                                        <td>{{ $project->commertial_register }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $project->status == 'started' ? 'bg-danger' : ($project->status == 'in_progress' ? 'bg-warning' : 'bg-success') }}">
                                                {{ $project->status == 'started' ? 'تم البدء' : ($project->status == 'in_progress' ? 'قيد التنفيذ' : 'مكتمل') }}
                                            </span>
                                        </td>

                                        <td>
                                            <a href="{{ asset($project->document) }}" target="_blank"
                                                class="text-blue-500 hover:underline">عرض</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('projects.edit', $project->id) }}"
                                                class="btn btn-warning btn-sm text-white">تعديل</a>
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm text-white">حذف</button>
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


</x-app-layout>
