@extends('carts.master');

@inject('cartService', 'App\Services\CartService')

@section('pageTitle', 'ショッピングカート｜Anyway-Grapes')

@section('contentsInnerHtml')
<span class="engFont" style="font-size:15px;">Shopping Cart</span>&nbsp;/&nbsp;<span style="font-size:10px;">ショッピングカート</span>
<hr class="lineThin" />
{{session()->getId()}}
@if ($cTotalWine == 0)
    <p>お客様の買い物カゴは空です。</p>
    <br /><br />
    <a href="{{ $returnUrl }}"><img src="{{ asset('images/cart/continue_shopping.png') }}" /></a>
@else
    <div id="giftPane">
        <a href="//anyway-grapes.jp/store/index.php?pc_view=1&submenu=gift"><img src="{{ asset('images/cart/gift_wrapping_btn.png') }}" /></a>
        <br /><br /><br />
    </div>
    @if (!$fDisableEdit)
    <p>
        ご購入の数量を入力した後、[更新] ボタンをクリックすると、商品の合計が再計算されます。<br />
        また、<u>削除</u>リンクをクリックして商品を買い物カゴから削除する事もできます。

    </p>
    <br />
    @endif
    @if (!$fLoggedIn)
    <p style="color:red;">
        ※会員価格でご購入頂くには、会員登録後に必ず<a href="{{url('login')}}?return_url={{$returnUrl}}">ログイン</a>してください。
    </p><br />
    @endif
{{ csrf_field() }}
        <table class="cartTable" style="width:100%;font-size:12px;">
            <thead>
                <tr>
                    <td>写真</td>
                    <td>商品名</td>
                    <td>数量</td>
                    <td>単価</td>
                    <td>金額</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($rgobjWine as $objWine)
                <tr>
                    <td class="imgCol">
                    @if ($objWine->barcode_number > 50000)
                        <img src="//anyway-grapes.jp/images/wine_sets/{{$objWine->barcode_number - 50000}}.png" onerror="this.src='//anyway-grapes.jp/images/wine_sets/no_wine_set_image.png';" />
                    @else
                        <img src="//anyway-grapes.jp/images/wines/100px/{{$objWine->barcode_number}}.png" onerror="this.src='//anyway-grapes.jp/images/wines/100px/no_wine_photo.jpg';" />
                    @endif
                    </td>
                    <td class="nameCol">
                    @if ($objWine->barcode_number < 1000)
                        <a href="//anyway-grapes.jp/store/index.php?pc_view=1&submenu=gift" />{{$objWine->vintage}}&nbsp;{{$objWine->name}}<br />[{{$objWine->producer}}]</a>
                    @elseif ($objWine->barcode_number > 50000)
                        <a href="//anyway-grapes.jp/store/index.php?pc_view=1&submenu=set_detail&id={{$objWine->barcode_number - 50000}}">{{ $objWine->name }}</a>
                    @else
                        <a href="//anyway-grapes.jp/store/index.php?submenu=wine_detail&id={{$objWine->barcode_number}}" target="_blank">{{$objWine->vintage}}&nbsp;{{$objWine->name}}<br />[{{$objWine->producer}}]</a>
                    @endif
                    </td>
                    <td>
                    @if (!$fDisableEdit)
                        <input type="number" id="qtyFld"    barcode_number="{{ $objWine->barcode_number }}" min="1" max="{{ $objWine->stock }}" value="{{ $objWine->quantity }}" />
                        <br /><br />
                        <a href="#" class="updateQtyLink" href="#" style="font-size:10px;">更新</a>
                    @else
                        {{$objWine->quantity}}
                    @endif
                    </td>
                    <td class="priceCol engFont">{{ $cartService->generatePriceHtml($objWine) }}</td>
                    <td class="priceCol engFont">{{ number_format($cartService->getPrice($objWine) * $objWine->quantity) }}&nbsp;yen</td>
                    <td class="operationCol">
                    @if (!$fDisableEdit)
                        <a id="{{$objWine->barcode_number}}" class="removeWineLnk" href="#">削除</a>
                    @endif
                    </td>
                </tr>
                @if ($objWine->stock == 0)
                <tr>
                    <td colspan="6" class="errorCol">
                    @if (!$fDisableEdit)
                        他のお客様が先に購入手続きをされたため、在庫が0個になりました。<br />
                        大変申し訳ございませんが、"削除"リンクをクリックしてカートから削除して下さい。
                    @else
                        申し訳ございません。この商品は完売いたしました。<br />
                        お手数ですが、画面右下の"カートを空にする"をクリックしてカートを空にしてください。
                    @endif
                    </td>
                </tr>
                @elseif ($objWine->stock < $objWine->quantity)
                <tr>
                    <td colspan="6" class="errorCol">
                        「 {{$objWine->vintage}}&nbsp;{{$objWine->name}} 」の在庫が残り{{$objWine->stock}} 個のため、ご希望の本数を購入頂く事ができません。お手数ですが、数量を変更後[更新]ボタンをクリックして下さい。
                    </td>
                </tr>
                @elseif ($objWine->apply == 'SO')
                <tr>
                    <td colspan="6" class="errorCol">
                        申し訳ございません。この商品は完売いたしました。<br />
                        お手数ですが、"削除"リンクをクリックしてカートから削除して下さい。
                    </td>
                </tr>
                @endif
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <strong>
                            合計&nbsp;{{ $cTotalWine or '&nbsp;' }}&nbsp;本&nbsp;[&nbsp;{{ $cartService->getDeliveryBoxCount($cTotalWine) }}&nbsp;個口&nbsp;]&nbsp;:&nbsp;&nbsp;
                            <span class="engFont">{{ number_format($intWineTotal) }}</span>（税抜）
                        </strong>
                    </td>
                    <td colspan="2">
                        <a id="clearCartLnk" href="#">カートを空にする</a>
                    </td>
                </tr>
                @if ($cartService->getWineSetCount() > 0)
                <tr>
                    <td colspan="6" style="color:green;">
                        1個口分の送料が無料になります（九州、沖縄、北海道を含む離島は除く）。<br />
                    </td>
                </tr>
                @elseif ($cartService->getFreeBoxCount($intWineTotal, $cTotalWine) > 0)
                <tr>
                    <td colspan="6" style="color:green;">
                        <span style="font-size:16px">{{ $cartService->getFreeBoxCount($intWineTotal, $cTotalWine) }}</span>&nbsp;個口分までの送料が無料になります（九州、沖縄、北海道を含む離島は除く）。
                    </td>
                </tr>
                @elseif ($intWineTotal > 0)
                <tr>
                    <td colspan="6" style="color:red;">
                        あと&nbsp;<span style="font-size:16px;">{{ $cartService->getFreeShippingPrice() - $intWineTotal }}</span>&nbsp;円で、1個口分の送料が無料になります（九州、沖縄、北海道を含む離島は除く）。
                    </td>
                </tr>
                @endif
            </tfoot>
        </table>
    <br /><br />
    <p style="text-align:center;font-size:14px;">
        <a href="{{ $returnUrl }}"><img src="{{ asset('images/cart/continue_shopping.png') }}" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @if ($cartService->canCheckout())
            <a href="{{ url('checkout') }}?return_url={{ $returnUrl }}&cart_type=0"><img src="{{ asset('images/cart/checkout.png') }}" /></a>
        @else
            <img src="{{ asset('images/cart/checkout_disabled.png') }}" />
        @endif
    </p>
@endif
@endsection

@section('javaScriptPane')
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
    $('table.cartTable').on('click', 'a#clearCartLnk,a.removeWineLnk', function()
    {
        var apiUrl     = '{{ url("carts") }}',
            strBarcode = $(this).attr('id');

        if (!isNaN(parseInt(strBarcode, 10)))
        {
            apiUrl = apiUrl + '/' + strBarcode;
        }
            
        $.ajax(
        { 
            url: apiUrl,
            type: 'DELETE',
            data: { _token: $('input[name=_token]').val() },
            cache: 'false',
            success: function(strText)
            {
                location.reload();
            },

            error: function(){}
        });

        return false;
    });

    $('table.cartTable').on('click', 'a.updateQtyLink', function()
    {
        var apiUrl     = '{{ url("carts") }}',
            $qtyInput  = $(this).siblings('input'),
            intQty     = $qtyInput.val(),
            strBarcode = $qtyInput.attr('barcode_number');

        $.ajax(
        { 
            url: apiUrl + '/' + strBarcode + '/' + intQty,
            type: 'PUT',
            data: { _token: $('input[name=_token]').val() },
            cache: 'false',
            success: function(strText)
            {
                location.reload();
            },

            error: function(){}
        });

        return false;
    });
});

</script>
@endsection
