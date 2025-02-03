<div class="rtl-container" style="direction: rtl;" id="apppend_here_alwahaj">
    <!-- Make the table scrollable on small screens -->
    <div class="table-responsive">
        <table class="table align-middle table-striped table-hover">
            <thead>
                <tr>
                    <!--<th>القسم</th>-->
                    <th>#</th>
                    <th>اسم طالب الخدمه</th>
                    <th>رقم الجوال</th>
                    <th>الايميل</th>
                    <th>الموقع</th>
                    <th>المساحه</th>
                    <th>السعر</th>
                    <th> الدوله</th>
                    <th> المدينه</th>
                    <th>نوع العقار</th>
                    <th>مقدم الطلب</th>
                    <th>وكيل</th>
                    <th>مكتب</th>
                    <th>شركه</th>
                    <th>مؤسسه</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $key=> $mawayeedproject)

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
                        <td></td>
                        <td></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Section -->
    <div class="text-end">
        <div id="wahaj_pagination">
            <!-- Pagination content here -->
        </div>
    </div>
</div>

