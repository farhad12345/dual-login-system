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
        <div class="d-flex justify-content-end mb-3 px-4">
            <a href="{{ route('admin.add.employee') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> {{ __('messages.add_user') }}             </a>
        </div>
        <div class="px-4">
            <div class="bg-light shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="rtl-container" style="direction: rtl;">
                        <table class="table table-bordered table-blue">
                            <thead>
                                <tr>
                                    <th>اسم الموظف</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>آخر تسجيل دخول</th>
                                    <th>آخر تسجيل خروج</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->last_login)->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->last_logout)->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.destroy', $user->id) }}"
                                           onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟')"
                                           class="btn btn-danger btn-sm">
                                            حذف
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $users->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script>
        function toggleDetails(id) {
            const details = document.getElementById('details-' + id);
            if (details.style.display === 'none' || details.style.display === '') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        }
        </script>
</x-app-layout>



