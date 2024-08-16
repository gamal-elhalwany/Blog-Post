<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
</head>
<body>
    <h1>NEWSROOM</h1>
    <p><b>Name:</b> {{ $contactContent['name'] }}</p>
    <p><b>Email:</b> {{ $contactContent['email'] }}</p>
    <p><b>Subject:</b> {{ $contactContent['subject'] }}</p>
    <p><b>Phone:</b> {{ $contactContent['phone'] }}</p>
    <p><b>Message:</b> {{ $contactContent['message'] }}</p>
</body>
</html>