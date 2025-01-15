<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آمرتم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .welcome-container {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .welcome-container h1 {
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .welcome-container .btn {
            width: 200px;
            margin-bottom: 10px;
        }
    </style>
        <style>
            .back{
        background-image: url('{{ asset('admin/ff1.jpg') }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
        </style>
</head>
  {{-- this is comment --}}
<body class="back">
    <div class="py-12 bg-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">

    <div class="welcome-container ">
        <h1>مرحبًا بك في نظام تسجيل الدخول المزدوج   </h1>
             {{-- {{ Hash::make('jumana@123') }} --}}
        <div>
            <a href="{{ route('login') }}?role=admin" class="btn btn-primary">تسجيل الدخول كمسؤول</a>
        </div>
        <div>
            <a href="{{ route('employee-login') }}?role=employee" class="btn btn-secondary">تسجيل الدخول كموظف</a>
        </div>
        <div>
            <a href="{{ route('register') }}" class="btn btn-success">التسجيل</a>
        </div>

        <div>
            <a href="{{ url('wahajwatan/register') }}" class="btn btn-success">وهج وطن العقارية تطبيق</a>
        </div>
        <div>
             <a href="{{ url('almawayeed/register') }}" class="btn btn-success">تطبيق المواعيد</a>
        </div>
    </div>
</div>  </div>

</html>
