<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="//anyway-grapes.jp/producers/header.css" />
        <link rel="stylesheet" type="text/css" href="//anyway-grapes.jp/producers/common.css" />
        <link rel="stylesheet" type="text/css" href="//anyway-grapes.jp/producers/body.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="//anyway-grapes.jp/producers/header_mobile.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="//anyway-grapes.jp/producers/body_mobile.css" />
        <script type="text/javascript">

        document.createElement('header');

        </script>
    </head>
    <body>
        <header>
            @yield('header_contents')
        </header>
        <div class="contents">
            @yield('contents')
        </div>
    </body>
</html>
