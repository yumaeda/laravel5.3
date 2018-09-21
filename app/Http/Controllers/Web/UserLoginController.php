<?php

namespace App\Http\Controllers\Web;
use App\User;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserLoginController extends Controller
{
    public function __construct()
    {
    }

    private function updateSessionIdInCart($oldId, $newId)
    {
        Cart::where('session_id', '=', $oldId)
            ->update(array('session_id' => $newId));
    }

    public function show(Request $request)
    {
        $returnUrl = $request->input('return_url');

        return view('carts.login', array(
                    'returnUrl' => $returnUrl,
                    'strError'  => ''
        ));
    }
	
	public function login(Request $request)
	{
		$strError  = '';
		$returnUrl = $request->has('return_url') ? $request->get('return_url') : 'http://anyway-grapes.jp/store';
		$email     = $request->has('email')      ? $request->get('email')      : '';
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE)
		{
			$strError = '正しい形式のメールアドレスを入力してください。';
		}

	    if (!$request->has('pwd') || empty($request->get('pwd')))
		{
			$strError = 'パスワードを入力してください';
		}
		
	    if ($strError === '')
		{
			$oldSessionId = session()->getId();
		    if (Auth::attempt([ 'email' => $email, 'password' => $request->get('pwd') ]))
		    {
				$rgobjUser = User::select(
				    'last_name', 'first_name', 'last_name_phonetic', 'first_name_phonetic', 'date_of_birth',
					'post_code', 'prefecture', 'address', 'phone')
		            ->where('email', $email)
			        ->get();

				$objUser = $rgobjUser[0];
				
			    session()->put('user_id', $email);
			    session()->put('email', $email);
			    session()->put('email_confirm', $email);

                if (($objUser != null) && !empty($objUser->date_of_birth))
				{
					list($wareki, $warekiYear, $warekiMonth, $warekiDate) = explode('/', $objUser->date_of_birth);
				
					session()->put('wareki',       $wareki);
					session()->put('wareki_year',  $warekiYear);
					session()->put('wareki_month', $warekiMonth);
					session()->put('wareki_date',  $warekiDate);
					
					session()->put('user_name',      $objUser->last_name . $objUser->first_name);
			        session()->put('phone',          $objUser->phone);
		    	    session()->put('first_name',     $objUser->first_name);
			        session()->put('last_name',      $objUser->last_name);
			        session()->put('first_phonetic', $objUser->first_name_phonetic);
			        session()->put('last_phonetic',  $objUser->last_name_phonetic);
			        session()->put('post_code',      $objUser->post_code);
			        session()->put('prefecture',     $objUser->prefecture);
			        session()->put('address',        $objUser->address);
				}
				
				session()->save();		
				$this->updateSessionIdInCart($oldSessionId, session()->getId());

                return redirect()->intended($returnUrl);
            }
			else
			{
				$strError = 'ご入力頂いたメール、もしくはパスワードが正しくありません。';
			}
		}
	
        return view('carts.login', array(
	        'returnUrl' => $returnUrl,
			'strError'  => $strError
		));
	}

	public function logout()
	{
		$oldSessionId = session()->getId();
		if (session()->has('user_id'))
		{
			session()->flush();
		}

        session()->regenerate();
		$this->updateSessionIdInCart($oldSessionId, session()->getId());

	    return redirect()->to('login');	
	}
}
