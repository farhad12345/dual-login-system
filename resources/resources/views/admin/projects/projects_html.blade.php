@foreach ($projects as $key=> $project)
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
   <td>{{$key+1}}</td>
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
            <div><strong>اسم الشركة:</strong> {{ $project->company_name }}
            </div>
            <div><strong>السجل التجاري:</strong>
                {{ $project->commertial_register }}
            </div>
            <div><strong> تاريخ البدء:</strong> {{ $project->start_date }}
            </div>
            <div><strong>عدد الأيام لإكمال :</strong>{{ $project->days }}</div>
            <div><strong>البريد الإلكتروني:</strong> <a
                    href="mailto:{{ $project->email }}">{{ $project->email }}</a>
            </div>
            <div><strong>البلد:</strong> {{ $project->country }}</div>
            <div><strong>مدينة:</strong> {{ $project->city }}</div>
            <div><strong>رقم الهاتف:</strong> {{ $project->person_contact }}
            </div>
            <div><strong>نوع النشاط التجاري:</strong>
                {{ $project->business_type }}
            </div>
            <div><strong>المستند :</strong>
                <a href="{{ asset($project->document) }}" target="_blank"
                    download class="btn btn-primary btn-sm">
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
            <small class="date-text">انتهى في:
                {{ $endDate->format('Y-m-d') }}</small>
        @else
            <span class="badge bg-success">في الوقت المحدد</span><br>
            <small class="date-text">ينتهي في:
                {{ $endDate->format('Y-m-d') }}</small>
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
            <input type="hidden" name="project_id"
                value="{{ $project->id }}">
            <textarea name="reason" rows="2" cols="10" placeholder="أدخل السبب هنا"></textarea>
            <button type="submit" class="btn btn-success">حفظ</button>

        </form>

    </td>
    <td><a
            href="{{ route('admin.projects.edit', $project->id) }}"
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
