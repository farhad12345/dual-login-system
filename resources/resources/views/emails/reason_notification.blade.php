<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إشعار السبب</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            line-height: 1.8;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 25px;
            background: linear-gradient(135deg, #ffffff, #f7f7f7);
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #eaeaea;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .header h1 {
            color: #4a90e2;
            font-size: 24px;
            margin: 0;
        }
        .header p {
            color: #555;
            font-size: 14px;
            margin: 5px 0 0;
        }
        .content {
            color: #333;
            font-size: 16px;
            line-height: 1.8;
            padding: 0 15px;
        }
        .content p {
            margin: 10px 0;
        }
        .blockquote {
            background: #f0f4ff;
            border-left: 4px solid #4a90e2;
            padding: 15px;
            margin: 20px 0;
            border-radius: 6px;
            font-style: italic;
            color: #333;
        }
        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #888;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #4a90e2;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>إشعار السبب</h1>
            <p>إدارة الموارد البشرية</p>
        </div>
        <div class="content">
            <p>عزيزي/عزيزتي <strong>{{ $employee->name }}</strong>,</p>
            <p>نود إبلاغكم بالسبب التالي الذي تم تسجيله من قبل الإدارة:</p>
            <div class="blockquote">
                <p>{{ $reason }}</p>
            </div>
            <p>إذا كان لديك أي استفسارات أو تحتاج إلى توضيح إضافي، يرجى عدم التردد في التواصل مع فريق الإدارة.</p>
        </div>
        <div class="footer">
            <p>شكراً لتفهمكم،</p>
            <p>فريق الإدارة</p>
            <p><a href="mailto:admin@example.com">saleh@amertm.com.sa</a> | <a href="tel:+966500607733">+966500607733</a></p>
        </div>
    </div>
</body>
</html>
