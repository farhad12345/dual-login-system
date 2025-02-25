<x-app-layout>

    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
<style>
    /* Mobile (max-width: 576px) */
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
    <div class="min-h-screen py-12">
        <div class="flex justify-center my-6">
            <img src="{{ asset('logo1.png') }}" class="logo">
        </div>
        <!-- Buttons to trigger table changes -->

        <div class="px-4 mb-4 d-flex justify-content-end">
            <button
                class="px-4 py-2 transition-all shadow-lg btn btn-outline-danger table-btn rounded-pill hover:scale-105 hover:bg-danger hover:text-white"
                data-target="table-1">
                <i class="mr-2 fas fa-briefcase"></i> آمرتم
            </button>&nbsp;&nbsp;
            <button
                class="px-4 py-2 transition-all shadow-lg btn btn-outline-info table-btn rounded-pill hover:scale-105 hover:bg-info hover:text-white"
                data-target="table-2">
                <i class="mr-2 fas fa-calendar-check"></i> المواعيد
            </button>&nbsp;&nbsp;
            <button
                class="px-4 py-2 transition-all shadow-lg btn btn-outline-success table-btn rounded-pill hover:scale-105 hover:bg-success hover:text-white"
                data-target="table-3">
                <i class="mr-2 fas fa-fire-alt"></i> وهج وطن
            </button>&nbsp;&nbsp;
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3 px-4">
            <!-- Left Aligned Button -->
            <a href="#" id="Prevoiusbtnmaweed" class="btn btn-primary addbutton">
                <i class="fas fa-eye"></i>المواعيد السابقه
            </a>

            <!-- Right Aligned Buttons (conditionally displayed) -->
            <div>
                <a href="{{ route('admin.projects.create') }}" id="newbtn1" class="btn btn-primary addbutton newbtn" style="display: block;">
                    <i class="fas fa-plus"></i> إضافة مشروع
                </a>
                <a href="{{ route('admin.almawayeed.create') }}" id="newbtn2" class="btn btn-primary addbutton newbtn" style="display: none;">
                    <i class="fas fa-plus"></i> إضافة مشروع
                </a>
                <a href="{{ route('admin.wahajprojects.create') }}" id="newbtn3" class="btn btn-primary addbutton newbtn" style="display: none;">
                    <i class="fas fa-plus"></i> إضافة مشروع
                </a>
                <a href="{{ route('admin.projects.create') }}" id="newbtn4" class="btn btn-primary addbutton newbtn" style="display: none;">
                    <i class="fas fa-plus"></i> إضافة مشروع
                </a>
            </div>
        </div>


        <div class="px-12">
            <div class="overflow-hidden rounded-lg shadow-md bg-light">

                <div class="p-12">
                    <div id="apppend_here_almaweed">


                    </div>
                    <div class="rtl-container" style="direction: rtl;">
                   <div id="table-1" class="table-container">
    <!-- Filters Section -->
    <div class="p-1 mb-4 rounded row s form-group">
        <div class="pt-2 col-md-3">
            <input type="text" name="employee_name" id="employee_name"
                value="{{ request('employee_name') }}"
                class="shadow-sm form-control form-control-lg" placeholder="اسم الموظف">
        </div>
        <div class="pt-2 col-md-4">
            <input type="text" name="companyname" id="companName"
                value="{{ request('companyname') }}"
                class="shadow-sm form-control form-control-lg" placeholder="اسم المنشأة">
        </div>
        <div class="pt-2 col-md-4">
            <select name="status" id="Filterstatus"
                class="shadow-sm form-select form-select-lg">
                <option value="">جميع الحالات</option>
                <option value="started" {{ request('status')=='started' ? 'selected' : '' }}>تم
                    البدء</option>
                <option value="in_progress" {{ request('status')=='in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>مكتمل</option>
            </select>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>اسم الموظف</th>
                    <th>اسم المنشأة</th>
                    <th>الخدمة المطلوبة</th>
                    <th> الجهة المقدمة لخدمة</th>
                    <th>آخر تسجيل دخول</th>
                    <th>حالة الوقت</th>
                    <th>الحالة</th>
                    <th>التقرير </th>
                    <th>التعديل</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="apppend_here">
                <!-- Dynamic Data Here -->
            </tbody>
        </table>
    </div>

    <!-- Pagination Section -->
    <div class="text-end">
        <div id="pagination">
            <!-- Pagination content here -->
        </div>
    </div>
</div>


                        <!-- Table 2 -->
                        <div id="table-2" class="hidden table-container">
                            <style>
                                .table-container {
                                    overflow-x: auto;
                                    /* Enable horizontal scroll on smaller screens */
                                    -webkit-overflow-scrolling: touch;
                                    /* Smooth scrolling for iOS */
                                }

                                .table-container table {
                                    width: 100%;
                                    border-collapse: collapse;
                                    table-layout: auto;
                                    /* Allow columns to adjust dynamically */
                                }

                                .table-container th,
                                .table-container td {
                                    white-space: nowrap;
                                    /* Keep text in one line */
                                    text-align: center;
                                    /* Center align text */
                                    overflow: hidden;
                                    /* Prevent overflow */
                                    text-overflow: ellipsis;
                                    /* Add ellipsis for overflow text */
                                    vertical-align: middle;
                                    /* Align text vertically */
                                    padding: 10px;
                                    /* Add padding for better readability */
                                    min-width: 100px;
                                    /* Ensure columns have a minimum width */
                                }

                                .table-container th {
                                    font-weight: bold;
                                    background-color: #f8f9fa;
                                    /* Light background for headers */
                                }

                                .table-container img {
                                    max-width: 100%;
                                    height: auto;
                                    /* Maintain aspect ratio for images */
                                }

                                /* Media queries for responsiveness */
                                @media screen and (max-width: 768px) {

                                    .table-container th,
                                    .table-container td {
                                        font-size: 12px;
                                        /* Reduce font size for smaller screens */
                                        padding: 5px;
                                        /* Reduce padding for smaller screens */
                                    }
                                }

                                @media screen and (max-width: 576px) {

                                    .table-container th,
                                    .table-container td {
                                        font-size: 10px;
                                        /* Further reduce font size for very small screens */
                                        min-width: 80px;
                                        /* Allow columns to shrink further */
                                    }
                                }
                            </style>

                            <table class="table table-bordered table-hover table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>اسم الموظف</th>
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
                                    @foreach ($mawayeedprojects as $mawayeedproject)
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
                                        <td>{{ $mawayeedproject->employee->name }}</td>
                                        <td>{{ $mawayeedproject->invitation_name }}</td>
                                        <td>{{ $types[$mawayeedproject->occasion] ?? 'غير محدد' }}</td>
                                        <td>{{ $mawayeedproject->day }}</td>
                                        <td>{{ $mawayeedproject->date }}</td>
                                        <td>{{ $mawayeedproject->time }}</td>
                                        <td>{{ $mawayeedproject->city }}</td>
                                        <td>{{ $mawayeedproject->address }}</td>
                                        <td><a href="{{ $mawayeedproject->link }}"><u>Link</u></a></td>
                                        <td>
                                            @if ($mawayeedproject->image)
                                            <a href="{{ asset($mawayeedproject->image) }}" target="_blank">
                                                <!--<img src="{{ asset($mawayeedproject->image) }}" alt="Project Image"-->
                                                <!--    style="width: 100px; height: 55px; cursor: pointer;">-->
                                                     <img src="{{ url('public/uploads/images/' . basename($mawayeedproject->image)) }}" alt="Project Image"
                                                                        style="width: 100px; height: 55px; cursor: pointer;">

                                            </a>
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.almawayeed.edit', $mawayeedproject->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-2"></i>&nbsp;التعديل
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.almawayeed.destroy', $mawayeedproject->id) }}"
                                                onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt me-2"></i>&nbsp; حذف المشروع
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <div class="mt-4">
                                    {{ $projects->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </table>
                        </div>

                        @php
                        $alkhidmaTypes = [
                        'record_number' => 'بيع',
                        'buying' => 'شراء',
                        'investement' => 'استثمار',
                        ];
                        $Propertytypes = [
                        'land' => 'ارض',
                        'building' => 'عمارة',
                        'villa' => 'فله',
                        'apartment' => 'شقة',
                        'hotel' => 'فندق',
                        'mall' => 'مول',
                        'indutrial_land' => 'ارض صناعية',
                        'commertial_warehous' => 'مستودعات تجارية',
                        'gas_stattion' => 'محطات وقود',
                        'failure' => 'قصور',
                        'farm' => 'مزارع',
                        ];
                        @endphp
                        <!-- Table 3 -->
                        <div id="table-3" class="hidden table-container">
                            <!-- Copy the same table structure as Table 1 -->
                            <table class="table table-bordered table-hover table-striped table-responsive">
                                <thead class="table-dark">
                                    <tr>
                                        <!--<th>القسم</th>-->
                                        <th>اسم الموظف</th>
                                        <th> المنشأة</th>
                                        <th>الخدمة </th>
                                        <th> نوع العقار</th>
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
                                    @foreach ($wahajprojects as $wahajproject)
                                    <tr>
                                        <td>{{ $wahajproject->employee->name }}</td>
                                        <td>
                                            <span class="clickable"
                                                onclick="toggleDetailsWahaj({{ $wahajproject->id }})">
                                                {{ $wahajproject->origin_name }}
                                            </span>
                                            <div id="detailswahaj-{{ $wahajproject->id }}" class="hidden details">
                                                <div><strong>اسم الشركة:</strong>
                                                    {{ $wahajproject->record_number }}
                                                </div>
                                                <div><strong> رقم رخصة فال:</strong>
                                                    {{ $wahajproject->license_number }}
                                                </div>
                                                <div><strong>رقم الهاتف :</strong>
                                                    {{ $wahajproject->record_number }}
                                                </div>
                                                <div><strong> الايميل :</strong> {{ $wahajproject->email }}
                                                </div>
                                                <div><strong> الموقع :</strong> {{ $wahajproject->site_link }}
                                                </div>
                                            </div>
                                        </td>
                                        <td> {{ $alkhidmaTypes[$wahajproject->service] ?? 'غير محدد' }}</td>
                                        <td>{{ $Propertytypes[$wahajproject->property_type] ?? 'غير محدد' }}</td>
                                        <td>{{ $wahajproject->area }}</td>
                                        <td>{{ $wahajproject->height }}</td>
                                        <td>{{ $wahajproject->width }}</td>
                                        <td>{{ $wahajproject->number_of_floors }}</td>
                                        <td>{{ $wahajproject->state }}</td>
                                        <td>{{ $wahajproject->city }}</td>
                                        <td>{{ $wahajproject->neighborhood }}</td>
                                        <td>{{ $wahajproject->street }}</td>
                                        {{-- <td>{{ $serviceTypes[$wahajproject->service_type] ?? 'غير محدد' }}</td>
                                        --}}
                                        <td><a href="{{ url('admin/wahajprojects/edit/' . $wahajproject->id) }}"
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
                                {{ $wahajprojects->links('vendor.pagination.bootstrap-5') }}
                            </div>

                        </div>

                        <!-- Table 4 -->
                        <div id="table-4" class="hidden table-container">
                            <!-- Copy the same table structure as Table 1 -->
                            <table class="table table-bordered table-hover table-striped table-responsive">
                                <thead class="table-dark">
                                    <tr>
                                        <th>اسم الموظف cc</th>
                                        <th>اسم المنشأة</th>
                                        <th>الخدمة المطلوبة</th>
                                        <th> الجهة المقدمة  للخدمة</th>
                                        <th>آخر تسجيل دخول</th>
                                        <th>حالة الوقت</th>
                                        <th>الحالة</th>
                                        <th>التقرير </th>
                                        <th>التعديل</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- ENd tables --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <!-- Total Employees Chart -->
            <div class="mb-4 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>إجمالي عدد الموظفين <b>: {{ $totalEmployees }}</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="totalEmployeesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Status Chart -->
            <div class="mb-4 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>حالة المشاريع</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="projectsStatusChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Last Login Activity Chart -->
            <div class="mb-4 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>آخر نشاط تسجيل الدخول</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="loginActivityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const totalEmployeesChartCanvas = document.getElementById('totalEmployeesChart');
            totalEmployeesChartCanvas.height = 300; // Set the desired height (adjust as needed)

            const totalEmployeesChart = new Chart(totalEmployeesChartCanvas.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: ['مقبول', 'قيد الانتظار', 'مرفوض'], // Add the status labels
                    datasets: [{
                        label: 'حالة الموظف',
                        data: [{{ $acceptedEmployees }}, {{ $pendingEmployees }},
                            {{ $rejectedEmployees }}
                        ], // Dynamic data from the backend
                        backgroundColor: ['#36a2eb', '#ffcd56',
                            '#ff6384'
                        ], // Different colors for each category
                        borderColor: ['#fff'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    // Show percentage and value in the tooltip
                                    const dataset = tooltipItem.dataset;
                                    const total = dataset.data.reduce((a, b) => a + b, 0);
                                    const currentValue = dataset.data[tooltipItem.dataIndex];
                                    const percentage = Math.floor((currentValue / total) * 100);
                                    return tooltipItem.label + ': ' + currentValue + ' (' + percentage +
                                        '%)';
                                }
                            }
                        }
                    }
                }
            });

            // Projects Status Chart
            const projectsStatusCtx = document.getElementById('projectsStatusChart').getContext('2d');
            const projectsStatusChart = new Chart(projectsStatusCtx, {
                type: 'bar',
                data: {
                    labels: ['بدأت', 'في تَقَدم', 'مكتمل', 'متأخر'],
                    datasets: [{
                        label: 'حالة المشاريع',
                        data: [{{ $projectsStarted }}, {{ $projectsInProgress }},
                            {{ $projectsCompleted }}, {{ $projectsOverdue }}
                        ], // Replace with dynamic data from your backend
                        backgroundColor: ['#ff6384', '#36a2eb', '#4bc0c0', '#ffcd56'],
                        borderColor: ['#fff'],
                        borderWidth: 1
                    }]
                }
            });

            // Last Login Activity Chart
            const loginActivityCtx = document.getElementById('loginActivityChart').getContext('2d');

            // Use json_encode to pass PHP arrays as JavaScript arrays
            const lastLoginDates = {!! json_encode($lastLoginDates) !!};
            const loginCounts = {!! json_encode($loginCounts) !!};

            const loginActivityChart = new Chart(loginActivityCtx, {
                type: 'line',
                data: {
                    labels: lastLoginDates, // Use the PHP array as a JavaScript array
                    datasets: [{
                        label: 'نشاط تسجيل الدخول',
                        data: loginCounts, // Use the PHP array as a JavaScript array
                        fill: false,
                        borderColor: '#ffcd56',
                        tension: 0.1
                    }]
                }
            });
        });

        GetAmertamData();

        function GetAmertamData(page = 1, per_page = 10) {
            var filterName = $("#employee_name").val();
            var statusFilter = $("#Filterstatus").val();
            var companyName = $("#companName").val();
            $.ajax({
                url: '/get/amertm_data/list?page=' + page + '&per_page=' + per_page,
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

                            $("#apppend_here").html(
                                '<tr class="text-center"><td colspan="10"><span class="fs-6 text-danger">No Data Found</span></td></tr>'
                            );
                        } else {
                            $('#check_loader_image').css('display', 'none');
                            console.log(response['html']);
                            $("#apppend_here").html(response['html']);
                        }
                        console.log(response['total']);
                        render_pagination_links(response['total'], per_page, page);
                        $('.loader').css('display', 'none');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function render_pagination_links(total_items, per_page, current_page) {
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
            $('#pagination').html(pagination_html);
        }
        $(document).on('input', '#employee_name', function(e) {
            $("#apppend_here").html('');
            GetAmertamData()
        });
        $(document).on('click', '#Prevoiusbtnmaweed', function(e) {
            $("#apppend_here").html('');
            $("#table-1").hide();
            $('#apppend_here_almaweed').show();
            $('#table-2').hide();
            $('#table-3').hide();
            $('#table-4').hide();
            GetMaweedPrevoiusData()
        });
        $(document).on('change', '#Filterstatus', function(e) {
            $("#apppend_here").html('');
            GetAmertamData()
        });
        $(document).on('change', '#companName', function(e) {
            $("#apppend_here").html('');
            GetAmertamData()
        });

        function toggleDetails(id) {
            const details = document.getElementById('details-' + id);
            if (details.style.display === 'none' || details.style.display === '') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        }

        function toggleDetailsMawayeed(id) {
            const details1 = document.getElementById('detailsmawayeed-' + id);
            if (details1.style.display === 'none' || details1.style.display === '') {
                details1.style.display = 'block';
            } else {
                details1.style.display = 'none';
            }
        }

        function toggleDetailsWahaj(id) {
            const details2 = document.getElementById('detailswahaj-' + id);
            if (details2.style.display === 'none' || details2.style.display === '') {
                details2.style.display = 'block';
            } else {
                details2.style.display = 'none';
            }
        }

        function toggleMonasebat(id) {
            const details = document.getElementById('detailsmonasebat-' + id);
            if (details.style.display === 'none' || details.style.display === '') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        }
        // Event listener for .table-btn clicks


    </script>
    <script>
        $(document).ready(function () {
    // Function to handle button visibility
    function handleButtonVisibility(targetId) {
        // Hide all "newbtn" buttons
        $('.newbtn').hide();
        $('#apppend_here_almaweed').hide();
        // Show the button corresponding to the targetId
        switch (targetId) {
            case 'table-1':
                $('#newbtn1').show();
                $("#table-1").show();
                GetAmertamData();
                $('#apppend_here_almaweed').hide();

                break;
            case 'table-2':
                $('#newbtn2').show();
                $('#apppend_here_almaweed').hide();
                $('#table-2').show();
                break;
            case 'table-3':
                $('#newbtn3').show();
                $('#apppend_here_almaweed').hide();
                $('#table-3').show();
                break;
            default:
                console.warn('No button associated with targetId:', targetId);
        }
    }

            // Event listener for table buttons
            $('.table-btn').on('click', function(e) {
                e.preventDefault(); // Prevent default button behavior

                // Remove the 'clicked' class from all buttons and reset their colors
                $('.table-btn').removeClass('clicked btn-primary btn-danger btn-info btn-success');

                // Add the 'clicked' class to the clicked button for highlight effect
                $(this).addClass('clicked'); // This adds the background color and highlight effect
                $('#apppend_here_almaweed').hide();
                // Optionally, add a specific color class based on button's data-target
                switch ($(this).data('target')) {
                    case 'table-1':
                        $(this).addClass('btn-danger'); // For آمرتم button
                        $('#apppend_here_almaweed').hide();
                        break;
                    case 'table-2':
                        $(this).addClass('btn-info'); // For المواعيد button
                        $('#apppend_here_almaweed').hide();
                        break;
                    case 'table-3':
                        $(this).addClass('btn-success'); // For وهج وطن button
                        $('#apppend_here_almaweed').hide();
                        break;
                    default:
                        $(this).addClass('btn-primary'); // Default color
                }

                // Hide all table containers
                $('.table-container').addClass('hidden');

                // Show the targeted table container
                const targetId = $(this).data('target');
                console.log('Target table:', targetId); // Debugging log
                $('#' + targetId).removeClass('hidden');

                // Update button visibility
                handleButtonVisibility(targetId);
            });
        });
        // GetMaweedPrevoiusData();

function GetMaweedPrevoiusData(page = 1, per_page = 10) {
    var filterName = $("#employee_name").val();
    var statusFilter = $("#Filterstatus").val();
    var companyName = $("#companName").val();
    $.ajax({
        url: '/get/maveed_prevoius_data/list?page=' + page + '&per_page=' + per_page,
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
</x-app-layout>
