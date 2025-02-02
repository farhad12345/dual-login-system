<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Arabic PDF</title>
    <style>
        @font-face {
            font-family: 'Amiri';
            src: url('{{ storage_path('fonts/amiri-regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'Amiri', sans-serif;
            direction: rtl;
            text-align: right;
        }
        table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: right;
        border: 1px solid #ddd;
    }

    </style>
</head>
<body>
    <h1>تقرير المشاريع</h1>
    <table>
        <thead>
            <tr>
                <th>اسم الشركة</th>
                <th>الخدمة المطلوبة</th>
                <th>تاريخ البدء</th>
                <th>اسم الشخص</th>
                <th>رقم التواصل</th>
                <th>نوع الخدمة</th>
                <th>المدينة</th>
                <th>السجل التجاري</th>
                <th>الحالة</th>
                <th>المستند</th>
                <th>ملاحظات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->company_name }}</td>
                    <td>{{ $project->service_required }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->person_name }}</td>
                    <td>{{ $project->person_contact }}</td>
                    <td>{{ $serviceTypes[$project->service_type] ?? 'غير محدد' }}</td>
                    <td>{{ $project->city }}</td>
                    <td>{{ $project->commertial_register }}</td>
                    <td>{{ $project->status }}</td>
                    <td><a href="{{ asset($project->document) }}">عرض</a></td>
                    <td>{{ $project->reason }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
