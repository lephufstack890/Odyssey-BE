<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .details {
            margin-bottom: 20px;
        }

        .details td {
            font-weight: bold;
            width: 30%;
        }

        .details td:nth-child(2) {
            width: 70%;
        }

        /* CSS cho trạng thái chưa thanh toán */
        .payment-status-unpaid {
            color: red;
        }

        /* CSS cho trạng thái đã thanh toán */
        .payment-status-paid {
            color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="title">Thông tin subcribe</h2>
        <table class="details">
            <tr>
                <td>Email:</td>
                <td>{{ $email }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
