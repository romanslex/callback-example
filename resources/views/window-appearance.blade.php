<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Настройка окна виджета</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,500,100italic,400,300italic&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/window-appearance.css">
    <style>
        *{padding: 0; margin: 0;}
        body{
            font-family: Roboto;
        }
    </style>
</head>
<body style="overflow: hidden;">
<div id="content" data-settings="{{$settings}}" data-url="{{$site}}" data-wid={{$wid}} data-currentWindow="{{$currentWindow}}">
</div>

<script src="/js/window-appearance.js"></script>
</body>
</html>