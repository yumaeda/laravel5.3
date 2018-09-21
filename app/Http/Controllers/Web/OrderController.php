<?php

namespace App\Http\Controllers\Web;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
	public function __construct()
	{
	}

	private function convertWarekiToYear($nengou, $year)
	{
		$fullYear = 0;
	
		if ($nengou === '平成')
		{
			$fullYear = $year + 1988;
		}
		elseif ($nengou === '昭和')
		{
			$fullYear = $year + 1925;
		}
		elseif ($nengou === '大正')
		{
			$fullYear = $year + 1911;
		}
	
		return $fullYear;
	}
	
	private function getAge($nengou, $year, $month, $date)
	{
		$birthYear = $this->convertWarekiToYear($nengou, $year);
		$strMonth  = intval($month);
		$strDate   = intval($date);
	
		if ($strMonth < 10)
		{
			$strMonth = '0' . $strMonth;
		}
		if ($strDate < 10)
		{
			$strDate = '0' . $strDate;
		}
	
		$birthDay = new DateTime("$birthYear-$strMonth-$strDate 00:00:00");
		$today    = new DateTime('00:00:00');
		$diff     = $today->diff($birthDay);
	
		return ($diff->y);
	}

    public function storeCustomerInfo(Request $request)
	{
		$inputErrors = array();
		$wareki      = $request->input('wareki');
        $warekiYear  = $request->input('wareki_year');
        $warekiMonth = $request->input('wareki_month');
        $warekiDate  = $request->input('wareki_date');

        if (!preg_match("/^[0-9]{1,2}$/", $warekiYear) ||
            (($warekiMonth < 1) || ($warekiMonth > 12)) ||
            (($warekiDate < 1) || ($warekiDate > 31)))
        {
            $inputErrors['wareki'] = '日付を入力してください。';
        }
        else if ($this->getAge($wareki, $warekiYear, $warekiMonth, $warekiDate) < 20)
        {
            $inputErrors['wareki'] = 'お客様は未成年なので、酒類をご購入頂けません。';
        }

        $lastName      = $request->input('last_name');
        $firstName     = $request->input('first_name');
        $lastPhonetic  = $request->input('last_phonetic');
        $firstPhonetic = $request->input('first_phonetic');
        $postCode      = $request->input('post_code');
        $prefecture    = $request->input('prefecture');
        $address       = $request->input('address');
        $phone         = $request->input('phone');

        $registerMailMagazine = 0;
        if ($request->has('mail_magazine') && ($request->input('mail_magazine') === '1'))
        {
            $registerMailMagazine = 1;
        }

        if (!$lastName || !$firstName)
        {
            $inputErrors['name'] = '名前（フルネーム）を入力してください。';
        }

        if (!$lastPhonetic || !$firstPhonetic)
        {
            $inputErrors['phonetic'] = 'ふりがな（フルネーム）を入力してください。';
        }

        if (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) &&
            filter_var($request->input('email_confirm'), FILTER_VALIDATE_EMAIL) &&
            ($request->input('email') === $request->input('email_confirm')))
        {
            $email = $request->input('email');
        }
        else
        {
            $inputErrors['email']         = '正しいメールアドレスを入力してください。';
            $inputErrors['email_confirm'] = $inputErrors['email'];
        }

        if (empty($inputErrors))
        {
            session()->put('first_name', $firstName);
            session()->put('last_name', $lastName);
            session()->put('first_phonetic', $firstPhonetic);
            session()->put('last_phonetic', $lastPhonetic);
            session()->put('phone', $phone);
            session()->put('post_code', $postCode);
            session()->put('prefecture', $prefecture);
            session()->put('address', $address);
            session()->put('mail_magazine', $registerMailMagazine);
            session()->put('email', $email);
            session()->put('wareki', $wareki);
            session()->put('wareki_year', $warekiYear);
            session()->put('wareki_month', $warekiMonth);
            session()->put('wareki_date', $warekiDate);

            return session()->all();
		}

		return var_dump($inputErrors);
	}
}