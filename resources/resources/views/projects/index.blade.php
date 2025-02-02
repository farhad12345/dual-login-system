<x-app-layout>
    <div class="container mt-4">
        <h2>المشاريع</h2>
        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">إضافة مشروع جديد</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#12</th>
                    <th>اسم الشركة</th>
                    <th>الخدمة المطلوبة</th>
                    <th>تاريخ البدء</th>
                    <th>تاريخ الإكمال</th>
                    <th>الحالة</th>
                    <th>الموظف</th>
                    <th>المستند</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $project->company_name }}</td>
                        <td>{{ $project->service_required }}</td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->completion_date }}</td>
                        <td>{{ $project->employee->name }}</td>
                        <td>
                            <span
                                class="badge
                            {{ $project->status == 'started' ? 'bg-danger' : ($project->status == 'in_progress' ? 'bg-warning' : 'bg-success') }}">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </td>
                        <td> <a href="{{ asset($project->document) }}" target="_blank">عرض</a></td>
                        <td>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
