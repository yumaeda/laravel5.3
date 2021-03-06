@extends('carts.master');

@inject('cartService', 'App\Services\CartService')

@section('pageTitle', '配送先の入力｜Anyway-Grapes')

@section('contentsInnerHtml')
    <div class="progressPane" align="center">
        <span>お客様情報</span>
        <span>&gt;&gt;</span>
        <span class="currentProgress">配送情報</span>
        <span class="currentProgress">&gt;&gt;</span>
        <span>注文内容の確認</span>
        <span>&gt;&gt;</span>
        <span>決済方法の選択</span>
        <span>&gt;&gt;</span>
        <span>終了</span>
    </div>
    <br style="clear:all;"/>
    @include('carts.readonly_cart')
    <form action="{{ url('delivery') }}" method="POST">
        {{ csrf_field() }}
        <br />
        <br />
        <table class="cartTable" style="width:100%;font-size:12px;">
        <thead>
            <tr>
                <td colspan="2" style="text-align:left;">配送先</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="labelCol">
                    <label for="delivery_option">受取り方法</label>
                </td>
                <td class="inputCol">

<!--        create_form_input('delivery_option', 'select', ' ', $inputErrors, $inputSrc); -->

                    <br />
                    <span style="color:red">※「店頭引き取り」を選択頂いた場合は1週間以内に商品を受け取りにお越しください。</span>
                    <br />
                    <span style="color:red">※「店頭引き取り」を選択頂いた場合のお支払い方法はクレジットカードのみとなっておりますのでご了承ください。</span>
                </td>
            </tr>
        </tbody>
        </table>
        <br />
        <br />
        <table class="cartTable" style="width:100%;font-size:12px;">
        <thead>
            <tr>
                <td colspan="2" style="text-align:left;">配送先の情報（「ご自宅以外に配送」を選択された場合にのみご記入下さい。）</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="labelCol">
                    <label for="name">お名前<span class="requiredCol">*</span></label>
                </td>
                <td class="inputCol">

<!--        create_full_name_input($inputErrors, $inputSrc, TRUE); -->

                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="phonetic">ふりがな<span class="requiredCol">*</span></label>
                </td>
                <td class="inputCol">

<!--        create_full_phonetic_input($inputErrors, $inputSrc, TRUE); -->

                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="delivery_post_code">
                        郵便番号<span class="requiredCol">*</span>
                    </label>
                </td>
                <td class="inputCol">

<!--        create_form_input('delivery_post_code', 'text', '156-0044', $inputErrors, $inputSrc); -->

                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="delivery_prefecture">
                        都道府県
                    </label>
                </td>
                <td class="inputCol">

<!--        create_form_input('delivery_prefecture', 'select', ' ', $inputErrors, $inputSrc); -->

                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="delivery_address">
                        住所<span class="requiredCol">*</span>
                    </label>
                </td>
                <td class="addressCol">

<!--        create_form_input('delivery_address', 'text', '世田谷区赤堤４－１－１　○○ビル１０１号室', $inputErrors, $inputSrc); -->

                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="delivery_phone">
                        電話番号<span class="requiredCol">*</span>
                    </label>
                </td>
                <td class="inputCol">

<!--        create_form_input('delivery_phone', 'text', '03-0000-0000', $inputErrors, $inputSrc); -->

                </td>
            </tr>
        </tbody>
        </table>
        <br />
        <br />
        <table class="cartTable" style="width:100%;font-size:12px;">
        <thead>
            <tr>
                <td colspan="2" style="text-align:left;">
                    配送日時＆配送方法（一部の地域で配送の遅延が発生する場合がございます。）<br />
                    <a href="http://www.kuronekoyamato.co.jp/chien/chien_hp.html" target="_blank">[ヤマト運輸]</a>
                    &nbsp;
                    <a href="http://www2.sagawa-exp.co.jp/information/list" target="_blank">[佐川急便]</a>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="labelCol">
                    <label for="delivery_company">配送業者</label>
                </td>
                <td class="inputCol">';

        @if ($cartService->getWineSetCount() > 0)
                    <select name="delivery_company">
                        <option value="ヤマト運輸" selected="selected">ヤマト運輸</option>
                    </select>
                    <br />
                    <span style="color:red">
                        ワインセットをご購入の場合はヤマト運輸での配送となりますのでご了承ください。<br /><br />
                        a) 通常便の場合、1セットのご購入につき合計12本までの送料が無料になります。<br />
                        b) クール便の場合、1セットのご購入につき合計9本までの送料が無料になります。
                    </span>
        @else
<!--        create_form_input('delivery_company', 'select', ' ', $inputErrors, $inputSrc); -->

                    <br />
                    <span style="color:red">※ヤマト運輸のクール便は1箱9本までとなっております。ご注文本数が10本以上の場合、2箱分の送料とクール料金がかかりますのでご了承ください。</span>
        @endif

                </td>
            </tr>
            </tr>
                <td class="labelCol">
                    <label for="delivery_date">配送希望日</label>
                </td>
                <td class="inputCol">

<!--        create_form_input('delivery_date', 'select', ' ', $inputErrors, $inputSrc); -->

                    <br />
                    <span style="color:red">※当日発送をご希望の場合は、下記の備考欄にその旨をご記入ください（集荷時間前までにご入金を確認できる場合に限ります）。</span>
                    <br /><br />
                    <span style="color:red">※当店の定休日が火曜日となっているため、水曜日着のお荷物は月曜日に発送いたしております。</span>
                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="deliveryTime">配送希望時間帯</label>
                </td>
                <td class="inputCol">

<!--        create_form_input('delivery_time', 'select', ' ', $inputErrors, $inputSrc); -->

                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="coolDelivery">クール便を利用する</label>
                </td>
                <td class="inputCol">

<!--        create_form_input('refrigerated', 'bool', ' ', $inputErrors, $inputSrc); -->

                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="comment">備考</label>
                </td>
                <td class="inputCol">

<!--        create_form_input('comment', 'note', "例）ワインを宅配ボックスには入れないで下さい。領収書を発行して下さい。", $inputErrors, $inputSrc); -->

                </td>
            </tr>
        </tbody>
        </table>
        <br style="clear:all;" />
        <div align="center">
            <a href="{{ url('checkout') }}"><img id="backBtn" src="{{ asset('images/cart/back_btn.png') }}" /></a>
            <input id="nextBtn" type="image" src="{{ asset('images/cart/next_btn.png') }}" value="" />
        </div>
   </form>
@endsection

@section('javaScriptPane')
@endsection

