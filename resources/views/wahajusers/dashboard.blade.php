<x-wahaj-layout>
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
            <a href="{{ route('wahajwatan.create') }}" class="btn btn-primary">
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
                                    <!--<th>القسم</th>-->
                                    <th>اسم الموظف</th>
                                    <th> المنشأة</th>
                                    <th>الخدمة </th>
                                    <th>  نوع العقار</th>
                                    <th>المساحة</th>
                                    <th>الطول</th>
                                    <th>العرض</th>
                                    <th>عدد الادوار </th>
                                    <th>الدولة </th>
                                    <th>المدينة</th>
                                    <th>الحي</th>
                                    <th>الشارع</th>
                                    <th>التعديل</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $wahajproject)

                                    <tr>
                                    <td>{{ $wahajproject->employee->name }}</td>
                                    <td>
                                        <span class="clickable"
                                            onclick="toggleDetailsWahaj({{ $wahajproject->id }})">
                                            {{ $wahajproject->origin_name }}
                                        </span>
                                        <div id="detailswahaj-{{ $wahajproject->id }}"
                                            class="details hidden">
                                            <div><strong>اسم الشركة:</strong> {{ $wahajproject->record_number }}
                                            </div>
                                            <div><strong> رقم رخصة فال:</strong> {{ $wahajproject->license_number }}
                                            </div>
                                            <div><strong>رقم الهاتف :</strong> {{ $wahajproject->record_number }}
                                            </div>
                                            <div><strong> الايميل :</strong> {{ $wahajproject->email }}
                                            </div>
                                            <div><strong> الموقع :</strong> {{ $wahajproject->site_link }}
                                            </div>
                                        </div>
                                    </td>
                                    <td> {{ $alkhidmaTypes[$wahajproject->service] ?? 'غير محدد' }}</td>
                                    <td>{{ $Propertytypes[$wahajproject->property_type] ?? 'غير محدد' }}</td>
                                    <td>{{  $wahajproject->area }}</td>
                                    <td>{{  $wahajproject->height }}</td>
                                    <td>{{  $wahajproject->width }}</td>
                                    <td>{{  $wahajproject->number_of_floors }}</td>
                                    <td>{{  $wahajproject->state }}</td>

                                    <td>{{  $wahajproject->city }}</td>

                                    <td>{{  $wahajproject->neighborhood }}</td>

                                    <td>{{  $wahajproject->street }}</td>


                                        {{-- <td>{{ $serviceTypes[$wahajproject->service_type] ?? 'غير محدد' }}</td> --}}




                                        <td><a target="_blank"
                                                href="{{ url('admin/wahajprojects/edit/' . $wahajproject->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-2"></i>&nbsp;التعديل
                                            </a></td>
                                        <td>
                                            <a href="{{ route('admin.wahajprojects.destroy', $wahajproject->id) }}"
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


</x-wahaj-layout>
