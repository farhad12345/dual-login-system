<x-wahaj-layout>
    <style>
        .rtl-container {
            direction: rtl;
            text-align: right;
        }
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
}

/* Larger devices (max-width: 1024px) */
@media screen and (max-width: 1024px) {
    .table-container img {
        width: 100px;
        height: 100px;
    }
}
@media (max-width: 767px) {

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
      <div class="px-12">
<div class="py-12 bg-blue-100 min-h-screen back">
    <div class="flex justify-center my-6">
        <img src="{{ asset('logo1.png') }}" class="logo">
    </div>

    <div class="flex justify-between items-center mb-3 px-4 flex-wrap">
        <a href="#" id="Prevoiusbtnmaweed" class="btn btn-primary addbutton mb-2 sm:mb-0">
            <i class="fas fa-eye"></i> المواعيد السابقه
        </a>
        <a href="{{ route('almawayeed.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إضافة مشروع
        </a>
    </div>

    <!-- Card Container -->
    <div class="px-4">
        <div class="shadow-md rounded-lg overflow-hidden bg-white">
            <div class="p-6">
                <div id="apppend_here_almaweed"></div>

                <div class="rtl-container" style="direction: rtl;" id="maindev">
                   <table class="table table-striped  table-hover align-middle w-full">

                        <thead>
                            <tr>
                                <th>اسم صاحب الدعوة</th>
                                <th>المناسبة</th>
                                <th>اليوم</th>
                                <th>التاريخ</th>
                                <th>الوقت</th>
                                <th>المدينة</th>
                                <th>العنوان</th>
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
                                    <td>{{ $mawayeedproject->city }}</td>
                                    <td>{{ $mawayeedproject->address }}</td>
                                    <td><a href="{{ $mawayeedproject->link }}" class="text-blue-500"><u>Link</u></a></td>
                                    <td>
                                        @if ($mawayeedproject->image)
                                            <img src="{{ url('public/uploads/images/' . basename($mawayeedproject->image)) }}" alt="Project Image" class="w-24 h-16 object-cover">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('almawayeed.edit', $mawayeedproject->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit me-2"></i>التعديل
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('almawayeed.destroy', $mawayeedproject->id) }}" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt me-2"></i> حذف المشروع
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
</div>
 <script>
        $(document).on('click', '#Prevoiusbtnmaweed', function(e) {
                   $('#apppend_here_almaweed').show();
            $("#apppend_here_almaweed").html('');
            $('#maindev').hide();
            GetMaweedPrevoiusData()
        });
        function GetMaweedPrevoiusData(page = 1, per_page = 10) {
    var filterName = $("#employee_name").val();
    var statusFilter = $("#Filterstatus").val();
    var companyName = $("#companName").val();
    $.ajax({
        url: '/get/maveed_prevoius_data/user/list?page=' + page + '&per_page=' + per_page,
        type: "Get",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            filterName: filterName,
            statusFilter: statusFilter,
            companyName: companyName
        },
        dataType: "JSON",
        cache: false,
        success: function(response) {
            console.log(response);
            if (response["status"] == "fail") {
                $('.loader').css('display', 'none');
                // toastr.error(response.msg);
            } else if (response["status"] == "success") {
                if (response['html'] == '') {

                    $("#apppend_here_almaweed").html(
                        '<tr class="text-center"><td colspan="10"><span class="fs-6 text-danger">No Data Found</span></td></tr>'
                    );
                } else {
                    $('#check_loader_image').css('display', 'none');
                    console.log(response['html']);
                    $("#apppend_here_almaweed").html(response['html']);
                }
                console.log(response['total']);
                render_maweed_pagination_links(response['total'], per_page, page);
                $('.loader').css('display', 'none');
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}
       function render_maweed_pagination_links(total_items, per_page, current_page) {
            // Calculate the total number of pages
            var total_pages = Math.ceil(total_items / per_page);

            var pagination_html = '';
            if (total_pages > 1) {
                // Add the "previous" link if the current page is not the first page
                if (current_page > 1) {
                    pagination_html += '<a href="javascript:;" onclick="GetAmertamData(' + (current_page -
                            1) +
                        ',' +
                        per_page + ')">Prev</a>';
                }
                // Add links for the current page and the surrounding pages
                for (var i = Math.max(current_page - 2, 1); i <= Math.min(current_page + 2, total_pages); i++) {
                    if (i == current_page) {
                        pagination_html += '<span>' + i + '</span>';
                    } else {
                        pagination_html += '<a href="javascript:;" onclick="GetAmertamData(' + i + ',' +
                            per_page + ')">' +
                            i + '</a>';
                    }
                }
                // Add the "next" link if the current page is not the last page
                if (current_page < total_pages) {
                    pagination_html += '<a href="javascript:;" onclick="GetAmertamData(' + (current_page +
                            1) +
                        ',' +
                        per_page + ')">Next</a>';
                }
            }
            $('#maweed_pagination').html(pagination_html);
        }
 </script>
</x-wahaj-layout>
