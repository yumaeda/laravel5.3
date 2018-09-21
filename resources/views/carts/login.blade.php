@extends('carts.master');

@section('pageTitle', 'ログイン｜Anyway-Grapes')

@section('contentsInnerHtml')
    <span class="engFont" style="font-size:15px;">Login</span>&nbsp;/&nbsp;<span style="font-size:10px;">ログイン</span>
    <hr class="lineThin" />
    <form action="{{url('login')}}?return_url={{$returnUrl}}" method="POST">
        {!! csrf_field() !!}
    @if ($strError)
        <div style="color:red;margin-bottom:15px;">{{$strError}}</div>
    @endif
        <table class="cartTable" style="width:100%;font-size:12px;">
            <tr>
                <td class="labelCol">Eメール</td>
                <td class="inputCol">
                    <input type="text" name="email" id="email" value="" placeholder="Eメール" /> 
                </td>
            </tr>
            <tr>
                <td class="labelCol">パスワード</td>
                <td class="inputCol">
                    <input type="password" name="pwd" id="pwd" value="" placeholder="パスワード" /> 
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:left;">
                    ※会員登録がお済みでない方は、<a href="http://anyway-grapes.jp/store/index.php?pc_view=1&submenu=member_rules">新規ご登録</a>をお願いします。
                </td>
            </tr>
        </table>
        <br />
        <p>
            パスワードを忘れてしまった方は、<a href="https://anyway-grapes.jp/forgot_password.php">パスワードのリセット</a>をお願いします。
        </p>
        <br style="clear:all;" />
        <div align="center">
            <a href="{{$returnUrl}}"><img id="backBtn" src="//anyway-grapes.jp/cart_images/back_btn.png" /></a>
            <input id="nextBtn" type="image" src="//anyway-grapes.jp/cart_images/next_btn.png" value="" />
        </div>
    </form>
@endsection
