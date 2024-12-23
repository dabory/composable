<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error 404</title>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="The most powerful Errors template">
    <meta name="keywords" content="Enter, your, keywords">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/error.css') }}">
</head>
<body>

<div class="main">
    <div class="error">404</div>
    <img src="{{ asset('/images/error/404.png') }}" />
    <h2>Page Not Found</h2>
    <h6>해당 페이지가 없습니다.</h6>
    <!--<h6>Something want wrong,<br />Please try again</h6>-->
    <div class="btn_wrap">
    	<a href="/" class="button">Home Page</a>
        <a href="/member-login" class="button">Member Login</a>
        <a href="/user-login" class="button">User Login</a>
    </div>
</div>
</body>
</html>
