<div class="rtl-container" style="direction: rtl;" id="apppend_here_almaweed">
    <table class="table align-middle table-striped table-hover">
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
                            <!--<img src="{{ asset($mawayeedproject->image) }}" alt="Project Image"-->
                            <!--    style="width: 100px; height: 65px;">-->
                                     <img src="{{ url('public/uploads/images/' . basename($mawayeedproject->image)) }}" alt="Project Image"
         style="width: 100px; height: 55px; cursor: pointer;">

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
    <div class="text-end">
    <div id="maweed_pagination">

                                    </div>
                                </div>
    </div>
