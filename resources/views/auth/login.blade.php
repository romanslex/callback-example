<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,500,100italic,400,300italic&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <title>CallBackService example</title>
    <style>
        *{margin: 0; padding: 0;}
        body{
            font-family: Roboto;
            font-weight: 300;
            font-size: 18px;
            line-height: 1.5;
        }
        p{
            margin: 5px 0;
        }
        .content{
            display: grid;
            grid-template-columns: 1fr 300px;
            grid-gap: 50px;
            width: 800px;
            margin: 0 auto;
            padding-top: 50px;
        }

        h1{
            font-weight: 400;
            font-size: 38px;
        }
        h3{
            font-weight: 300;
        }

        .content .header{
            margin-bottom: 1px;
            margin-top: 10px;
        }
        .content input{
            outline: none;
            font-size: 18px;
            padding: 5px;
            width: 100%;
        }
        .content a{
            text-decoration: none;
            color: #275cad;
            font-size: 13px;
        }
        .content button{
            text-transform: uppercase;
            width: 100%;
            display: block;
            padding: 8px 15px;
            font-size: 14px;
            font-weight: 400;
            cursor: pointer;
            transition: box-shadow 0.15s ease-out;
            background: #5089e0;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
            color: white;
            border: none;
            margin-top: 10px;
        }
        .content button:hover{
            background: #3274e0;
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.38);
        }

        .content .error-block{
            margin-top: 5px;
        }
        .content .error{
            font-size: 13px;
            color: red;
        }

        ul{
            list-style: none;
        }
        ul li:before{
            content: "—";
            margin-right: 5px;
        }
    </style>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>
<div class="content">
    <div>
        <h1>Привет!</h1>
        <p>Это страница входа в тестовый сервис обратного звонка.</p>
        <p>Данный сервис создан только в ознакомительных целях, так что не стоит ожидать его полной работоспособности.</p>
        <p>Стек технологий:</p>
        <ul>
            <li>Laravel 5.7</li>
            <li>Vue.js 2</li>
            <li>MySQL</li>
            <li>pug, stylus</li>
        </ul>
    </div>
    <div>
        <h1>Вход в систему</h1>
        <form class="login-form" method="post" action="/login">
            {{csrf_field()}}

            @if ($errors->any())
                <div class="error-block">
                    @foreach ($errors->all() as $error)
                        <div class="error">{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="header">Введите email</div>
            <input name="email" type="text" value="admin@callback.mail">

            <div class="header">Введите пароль</div>
            <input name="password" type="password" style="margin-bottom: 5px;" value="secret">

            <button type="submit">Войти</button>
        </form>
    </div>
</div>
@include('counters.ganalytics')
@include('counters.ymetrika')
</body>
</html>