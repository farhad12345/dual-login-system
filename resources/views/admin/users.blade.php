<x-app-layout>
<style>
    .back1{
    background-image: url('ff1.jpg');
    background-repeat: no-repeat;
    background-size: cover

}
</style>
@section('title', 'Users')
    <div class="py-12 min-h-screen back1">
        <div class="flex justify-center my-6">
            <img src="{{ asset('logo1.png') }}" class="logo">
        </div>
        <div class="d-flex justify-content-end mb-3 px-4">
            <a href="{{ route('admin.add.employee') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> {{ __('messages.add_user') }}             </a>
        </div>
        <div class="px-4 ">
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
                                    <th>حالة</th>
                                    <th>تغيير الحالة</th>
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
                                        @if ($user->status === 'pending')
                                            <a href="#" class="btn btn-warning btn-sm">قيد الانتظار</a>
                                        @elseif ($user->status === 'accepted')
                                            <a href="#" class="btn btn-success btn-sm">مقبول</a>
                                        @elseif ($user->status === 'rejected')
                                            <a href="#" class="btn btn-danger btn-sm">مرفوض</a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.user.status', $user->id) }}" method="POST">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                                <option value="accepted" {{ $user->status === 'accepted' ? 'selected' : '' }}>مقبول</option>
                                                <option value="rejected" {{ $user->status === 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                            </select>
                                        </form>
                                    </td>

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



