@extends('carts.master');

@inject('cartService', 'App\Services\CartService')

@section('pageTitle', 'お客様情報の入力｜Anyway-Grapes')

@section('contentsInnerHtml')
    <div class="progressPane" align="center">
        <span class="currentProgress">お客様情報</span>
        <span class="currentProgress">&gt;&gt;</span>
        <span>配送情報</span>
        <span>&gt;&gt;</span>
        <span>決済方法の選択</span>
        <span>&gt;&gt;</span>
        <span>注文内容の確認</span>
        <span>&gt;&gt;</span>
        <span>終了</span>
    </div>
    <br style="clear:all;"/>
    @include('carts.readonly_cart')
    <form action="{{ url('checkout') }}" method="POST">
        {{ csrf_field() }}
        <br />
        <br />
        <table class="cartTable" style="width:100%;font-size:12px;">
        <thead>
            <tr>
                <td colspan="2" style="text-align:left;">年齢の確認（20歳未満の方には酒類を販売しておりません。）</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="labelCol">
                    <label for="date_of_birth">生年月日<span class="requiredCol">*</span></label>
                </td>
                <td class="inputCol">
                <select name="wareki">
                    <option value="大正">大正</option>
                    <option value="昭和">昭和</option>
                    <option value="平成">平成</option>
                </select>
                &nbsp;&nbsp;
                <input type="text" name="wareki_year" id="wareki_year" maxlength="2" size="2" autocomplete="off" />
                &nbsp;年&nbsp;
                <input type="text" name="wareki_month" id="wareki_month" maxlength="2" size="2" autocomplete="off" />
                &nbsp;月&nbsp;
                <input type="text" name="wareki_date" id="wareki_date" maxlength="2" size="2" autocomplete="off" />
                &nbsp;日&nbsp;            
                </td>
            </tr>
        </tbody>
        </table>
        <br />
        <br />
        <table class="cartTable" style="width:100%;font-size:12px;">
        <thead>
            <tr>
                <td colspan="2" style="text-align:left;">ご注文者の情報</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="labelCol">
                    <label for="name">お名前<span class="requiredCol">*</span></label>
                </td>
                <td class="inputCol">
                    姓:&nbsp;<input type="text" name="last_name" id="last_name">&nbsp;&nbsp;
                    名:&nbsp;<input type="text" name="first_name" id="first_name">
                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="phonetic">ふりがな<span class="requiredCol">*</span></label>
                </td>
                <td class="inputCol">
                    せい:&nbsp;<input type="text" name="last_phonetic" id="last_phonetic">&nbsp;&nbsp;
                    めい:&nbsp;<input type="text" name="first_phonetic" id="first_phonetic">
                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="post_code">
                        郵便番号<span class="requiredCol">*</span>
                    </label>
                </td>
                <td class="inputCol">
                    <input type="text" name="post_code" id="post_code">
                        <span class="exampleSpan">&nbsp;&nbsp;例）156-0044</span>
                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="prefecture">
                        都道府県
                    </label>
                </td>
                <td class="inputCol">
                    <select name="prefecture"><option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="address">
                        住所<span class="requiredCol">*</span>
                    </label>
                </td>
                <td class="addressCol">
                    <input type="text" name="address" id="address"><span class="exampleSpan">&nbsp;&nbsp;例）世田谷区赤堤４－１－１　○○ビル１０１号室</span>
                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="phone">
                        電話番号<span class="requiredCol">*</span>
                    </label>
                </td>
                <td class="inputCol">
                    <input type="text" name="phone" id="phone">
                    <span class="exampleSpan">&nbsp;&nbsp;例）03-0000-0000</span>
                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label for="email">
                        メールアドレス<span class="requiredCol">*</span>
                    </label>
                </td>
                <td class="inputCol">
                    <input type="text" name="email" id="email">
                </td>
            </tr>
            <tr>
                <td class="labelCol">
                    <label>
                        メールアドレス（確認用）<span class="requiredCol">*</span>
                    </label>
                </td>
                <td class="inputCol">
                    <input type="text" name="email_confirm" id="email_confirm">
                </td>
            </tr>
        </tbody>
        </table>
        <br />
        <br />
        <table class="cartTable" style="width:100%;font-size:12px;">
        <thead>
            <tr>
                <td colspan="2" style="text-align:left;">その他</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="labelCol">
                    <label for="mailMagazine">メールマガジンを購読する</label>
                </td>
                <td class="inputCol">
                    <input type="checkbox" name="mail_magazine" value="1" id="mail_magazine">
                </td>
            </tr>
        </tbody>
        </table>
        <br style="clear:all;" />
        <div align="center">
            <a href="{{ url('cart') }}"><img id="backBtn" src="{{ asset('images/cart/back_btn.png') }}" /></a>
            <input id="nextBtn" type="image" src="{{ asset('images/cart/next_btn.png') }}" value="" />
        </div>
   </form>
@endsection

@section('javaScriptPane')
@endsection

