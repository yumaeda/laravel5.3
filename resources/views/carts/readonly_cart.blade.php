<p>お客様の買い物カゴには、以下の商品が入っています。</p>
<br />

<table class="cartTable" style="width:100%;font-size:12px;">
    <thead>
        <tr>
            <td>写真</td>
            <td>商品名</td>
            <td>数量</td>
            <td>単価</td>
            <td>金額</td>
        </tr>
    </thead>
    <tbody>
    @foreach ($rgobjWine as $objWine)
        <tr>
            <td class="imgCol">
            @if ($objWine->barcode_number > 50000)
                <img src="//anyway-grapes.jp/images/wine_sets/{{ $objWine->barcode_number - 50000 }}.png" onerror="this.src='//anyway-grapes.jp/images/wine_sets/no_wine_set_image.png';" />
            @else
                <img src="//anyway-grapes.jp/images/wines/100px/{{ $objWine->barcode_number }}.png" onerror="this.src='//anyway-grapes.jp/images/wines/100px/no_wine_photo.jpg';" />
            @endif
            </td>
            <td class="nameCol">
            @if ($objWine->barcode_number > 50000)
                {{ $objWine->name }}
            @else
                {{ $objWine->vintage }}&nbsp;{{ $objWine->name }}<br />[{{ $objWine->producer }}]
            @endif
            </td>
            <td>{{ $objWine->quantity }}</td>
            <td class="priceCol engFont">{{ $cartService->generatePriceHtml($objWine) }}</td>
            <td class="priceCol engFont">{{ number_format($cartService->getPrice($objWine) * $objWine->quantity) }}&nbsp;yen</td>
        </tr>
    @endforeach
        <tr>
            <td colspan="3">
                <span class="engFont">{{ $cartService->getWineTotalAsText() }}</span> (小計)
                @if (session()->has('shipping_fee'))
                &nbsp;&nbsp;+&nbsp;&nbsp;
                <span class="engFont">{{ $cartService->getShippingFeeAsText() }}</span> (配送料)
                @endif
                @if (session()->has('cool_fee'))
                &nbsp;&nbsp;+&nbsp;&nbsp;
                <span class="engFont">{{ $cartService->getCoolFeeAsText() }}</span> (クール便)
                @endif
                &nbsp;&nbsp;+&nbsp;&nbsp;
                <span class="engFont">{{ $cartService->getTaxAsText() }}</span> (消費税)
            </td>
            <td colspan="2">
                <strong>
                    総額:&nbsp;&nbsp;<span class="engFont">{{ $cartService->getGrandTotalAsText() }}</span>
                </strong>
            </td>
        </tr>
    </tbody>
</table>
