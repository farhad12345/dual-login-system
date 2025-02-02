<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Project Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            width: 90%;
            margin: auto;
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Project Created</h2>
        <p>Dear Admin,</p>
        <p>A new project has been created with the following details:</p>

        <table>
            <tr>
                <th>Field</th>
                <th>Details</th>
            </tr>
            <tr>
                <td>Company Name</td>
                <td>{{ $project['company_name'] }}</td>
            </tr>
            <tr>
                <td>Service Required</td>
                <td>{{ $project['service_required'] }}</td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td>{{ $project['start_date'] }}</td>
            </tr>

            <tr>
                <td>Status</td>
                <td>{{ ucfirst($project['status']) }}</td>
            </tr>
            <tr>
                <td>Person Name</td>
                <td>{{ $project['person_name'] }}</td>
            </tr>
            <tr>
                <td>Contact</td>
                <td>{{ $project['person_contact'] }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $project['email'] }}</td>
            </tr>
            <tr>
                <td>Ministry</td>
                <td>{{ $project['ministry'] }}</td>
            </tr>
            <tr>
                <td>Business Type</td>
                <td>{{ $project['business_type'] }}</td>
            </tr>
            <tr>
                <td>Days</td>
                <td>{{ $project['days'] }}</td>
            </tr>
            <tr>
                <td>Service Type</td>
                <td>{{ $project['service_type'] }}</td>
            </tr>
            <tr>
                <td>City</td>
                <td>{{ $project['city'] }}</td>
            </tr>
            <tr>
                <td>Commercial Register</td>
                <td>{{ $project['commertial_register'] }}</td>
            </tr>
        </table>

        @if ($project['document'])
        <p><strong>Document:</strong> <a href="{{ asset($project['document']) }}" target="_blank">View Document</a></p>
        @endif

        <p class="footer">Thank you,<br>Your System</p>
    </div>
</body>
</html>
