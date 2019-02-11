<!
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content={{csrf_token()}}>
    <link rel="stylesheet" href="/css/app.css">
    <title>Home</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
    </style>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>
<div id="app" data-user="{{ json_encode($user) }}">
</div>

<script src="/js/app.js"></script>
@include('counters.ganalytics')
@include('counters.ymetrika')
</body>
</html>