<x-wahaj-layout>
    <style>
<style>
    .rtl-container {
        direction: rtl;
        text-align: right;
    }

    /* Make the table responsive */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Style the table for smaller screens */
@media screen and (max-width: 576px) {
    .logo{
     position: relative;
    margin-top: -80px;
        
    }
    .addbutton {
     width:130px;   
     color:white;
    }
    .table-btn {
        font-size: 14px;
      color: lavenderblush;
    }
    .table-container th,
    .table-container td {
        font-size: 10px;
        padding: 5px;
        min-width: 80px;
    }

    .table-container img {
        width: 50px;
        height: 50px;
    }

    /* Adjust filter section */
    .form-group .col-md-3, .form-group .col-md-4 {
        padding-right: 0;
        padding-left: 0;
            margin: 4px;
    }

    .form-group input,
    .form-group select {
        font-size: 12px;
                width: 300px;
                   margin: 5px;
    }
}

/* Tablets (max-width: 768px) */
@media screen and (max-width: 768px) {
    .table-container th,
    .table-container td {
        font-size: 12px;
        padding: 8px;
    }

    .table-container img {
        width: 80px;
        height: 80px;
    }

    /* Adjust filter section */
    .form-group .col-md-3, .form-group .col-md-4 {
        padding-right: 0;
        padding-left: 0;
    }

    .form-group input,
    .form-group select {
        font-size: 14px;
    }
}

/* Larger devices (max-width: 1024px) */
@media screen and (max-width: 1024px) {

    .table-container img {
        width: 100px;
        height: 100px;
    }

    /* Adjust filter section */


    .form-group input,
    .form-group select {
        font-size: 16px;
    }
}
@media (max-width: 767px) {
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .addbutton {
     width:130px;   
     color:white;
    }
    /* Adjust table font size for smaller screens */
    .table td, .table th {
        font-size: 0.9rem;
    }
}
</style>

    
<div class="py-12 bg-blue-100 min-h-screen back">
    <div class="flex justify-center my-6">
        <img src="{{ asset('logo1.png') }}" class="logo">
    </div>

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
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>اسم الموظف</th>
                                    <th>المنشأة</th>
                                    <th>الخدمة</th>
                                    <th>نوع العقار</th>
                                    <th>المساحة</th>
                                    <th>الطول</th>
                                    <th>العرض</th>
                                    <th>عدد الادوار</th>
                                    <th>الدولة</th>
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
                                        <td data-label="اسم الموظف">{{ $wahajproject->employee->name }}</td>
                                        <td data-label="المنشأة">
                                            <span class="clickable" onclick="toggleDetailsWahaj({{ $wahajproject->id }})">
                                                {{ $wahajproject->origin_name }}
                                            </span>
                                            <div id="detailswahaj-{{ $wahajproject->id }}" class="details hidden">
                                                <div><strong>اسم الشركة:</strong> {{ $wahajproject->record_number }}</div>
                                                <div><strong>رقم رخصة فال:</strong> {{ $wahajproject->license_number }}</div>
                                                <div><strong>رقم الهاتف:</strong> {{ $wahajproject->record_number }}</div>
                                                <div><strong>الايميل:</strong> {{ $wahajproject->email }}</div>
                                                <div><strong>الموقع:</strong> {{ $wahajproject->site_link }}</div>
                                            </div>
                                        </td>
                                        <td data-label="الخدمة">{{ $alkhidmaTypes[$wahajproject->service] ?? 'غير محدد' }}</td>
                                        <td data-label="نوع العقار">{{ $Propertytypes[$wahajproject->property_type] ?? 'غير محدد' }}</td>
                                        <td data-label="المساحة">{{ $wahajproject->area }}</td>
                                        <td data-label="الطول">{{ $wahajproject->height }}</td>
                                        <td data-label="العرض">{{ $wahajproject->width }}</td>
                                        <td data-label="عدد الادوار">{{ $wahajproject->number_of_floors }}</td>
                                        <td data-label="الدولة">{{ $wahajproject->state }}</td>
                                        <td data-label="المدينة">{{ $wahajproject->city }}</td>
                                        <td data-label="الحي">{{ $wahajproject->neighborhood }}</td>
                                        <td data-label="الشارع">{{ $wahajproject->street }}</td>
                                        <td data-label="التعديل">
                                            <a target="_blank" href="{{ route('wahajwatan.edit' , $wahajproject->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-2"></i>&nbsp;التعديل
                                            </a>
                                        </td>
                                        <td data-label="الإجراءات">
                                            <a href="{{ route('wahajwatan.destroy', $wahajproject->id) }}" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt me-2"></i>&nbsp;حذف المشروع
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $projects->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</x-wahaj-layout>
