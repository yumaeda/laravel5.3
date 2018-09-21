<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Yukitaka Maeda">
        <title>@yield('pageTitle', 'Conceptual Wine Boutique Anyway-Grapes')</title>
        <script type="text/javascript">

        document.createElement('header');
        document.createElement('aside');
        document.createElement('footer');

        function preventBack()
        {
            window.history.forward();
        }

        setTimeout('preventBack()', 0);
        window.onunload = function(){ null };

        </script>
        <link rel="stylesheet" type="text/css" href="//anyway-grapes.jp/css/cart.css" />
        <style type="text/css">

        @media only screen and (max-device-width: 480px)
        {
            header, aside, div.contents, footer
            {
                width: 100%;
            }

            td.inputCol
            {
                width: auto;
            }

            td.inputCol input
            {
                height: 20px;
            }

            td.addressCol input
            {
                height: 20px;
            }

            img#cardLogos
            {
                width: 75%;
            }
        }

        @media print
        {
            header
            {
                display:none;
            }
        }

        </style>
    </head>
    <body>
        <header>
            <img class="logoImg" src="//anyway-grapes.jp/cart_images/logo_top.png" />
        </header>
        <aside>
            @yield('asideInnerHtml')
        </aside>
        <div class="contents">
            <div class="box alt">
                <div class="left-top-corner">
                    <div class="right-top-corner">
                        <div class="border-top"></div>
                    </div>
                </div>
                <div class="border-left">
                    <div class="border-right">
                        <div class="inner">
                            @yield('contentsInnerHtml')
                        </div>
                    </div>
                </div>
                <div class="left-bot-corner">
                    <div class="right-bot-corner">
                        <div class="border-bot">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="engFont">
            <span>&copy; Conceptual Wine Boutique Anyway-Grapes {{ date('Y') }}</span>
            @if (!empty($_SERVER['HTTPS']))
                <table style="margin-top:10px;font-size:12px;">
                    <tr>
                        <td>
                            <span id="ss_gmo_img_wrapper_100-50_image_ja">
                                <a href="https://jp.globalsign.com/" target="_blank" rel="nofollow">
                                    <img alt="SSL　GMOグローバルサインのサイトシール" border="0" id="ss_img" src="//seal.globalsign.com/SiteSeal/images/gs_noscript_100-50_ja.gif">
                                </a>
                            </span>
                            <script type="text/javascript" src="//seal.globalsign.com/SiteSeal/gmogs_image_100-50_ja.js" defer="defer"></script>
                        </td>
                        <td style="text-align:left;padding-left:10px;">
                            当サイトでは、お客様に安心して買い物をしていただくため、グローバルサインから発行されたSSLサーバ証明書により、通信情報の暗号化とドメインの証明を行っています。
                        </td>
                    </tr>
                </table>
            @endif
        </footer>
    </body>
</html>
@yield('javaScriptPane')
