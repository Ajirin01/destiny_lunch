<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mail</title>
</head>
<body>
<p>reply_to: site_email@gmail.com</p>
<p>message: <br> Welcome <b>{{$email['name']}}!</b></p>
<p>You have successfully subscribed to our newsletters!</p>
<p>Click the link below to unsubscribe anything</p>
<a href="destiny.com/unsubscribe-newsletter/{{$email['email']}}">unsubscribe</a>

</body>
</html>