<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TMS Private School</title>
</head>

<body>
    <h4>Student Details:</h4>
    <ul>
        <li>Id : {{ $mailData['id'] }}</li>
        <li>Name : {{ $mailData['name'] }}</li>
        <li>Email : {{ $mailData['email'] }}</li>
        <li>Major : {{ $mailData['majorName'] }}</li>
        <li>Phone : {{ $mailData['phone'] }}</li>
        <li>Address : {{ $mailData['address'] }}</li>
    </ul>
</body>

</html>
