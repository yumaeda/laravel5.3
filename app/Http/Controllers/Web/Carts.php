<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;
use App\Http\Controllers\Controller;

class Carts extends Controller
{
	private $intWineTotal;
	private $cSetWine;
	private $cWine;
	private $fLoggedIn;

    private function setWineCount()
	{
        $objItem = DB::table('carts')
		    ->select(DB::raw(
			    'SUM(CASE WHEN (carts.product_id <= 50000)
				    THEN
					    carts.quantity
					ELSE
					    (carts.quantity * (SELECT COUNT(*) FROM set_wines WHERE (set_wines.set_id + 50000) = carts.product_id))
					END
			    ) AS total_count'))   
			->where('carts.session_id', '=', session()->getId())
			->first();

        $this->cWine = $objItem->total_count;
	}

    private function getWines()
	{
        $cartWines = DB::table('carts')
	        ->leftJoin('wines', 'carts.product_id', '=', 'wines.barcode_number')
            ->select('carts.product_id AS barcode_number', 'carts.quantity', 'wines.vintage', 'wines.type', 'wines.apply', 'wines.etc', 'wines.producer_jpn AS producer', 'wines.member_price', 'wines.stock', 'wines.price', 'wines.combined_name_jpn AS name')
		    ->where('carts.session_id', '=', session()->getId())
		    ->orderBy('carts.id', 'asc')
            ->get();

        return $cartWines;
	}

	public function __construct()
	{
	    $this->fLoggedIn =
		    (session()->get('user_id', false) && session()->get('user_name', false));

        $objTmp = null;
		if ($this->fLoggedIn)
		{
		    $objTmp = DB::table('carts')
	            ->join('wines', 'carts.product_id', '=', 'wines.barcode_number')
                ->select(DB::raw('SUM(carts.quantity * wines.member_price) AS total_price'))
		        ->where('carts.session_id', '=', session()->getId())
                ->first();
		}
		else
		{
		    $objTmp = DB::table('carts')
	            ->join('wines', 'carts.product_id', '=', 'wines.barcode_number')
                ->select(DB::raw('SUM(carts.quantity * wines.price) AS total_price'))
		        ->where('carts.session_id', '=', session()->getId())
                ->first();
		}
		
		$objTmp2 = DB::table('carts')
		    ->join('set_wines', 'carts.product_id', '=', DB::raw('set_wines.set_id + 50000'))
            ->join('wines', 'wines.barcode_number', '=', 'set_wines.barcode_number')
			->leftJoin('wine_sets', 'set_wines.set_id', '=', 'wine_sets.id')
            ->select(DB::raw('FLOOR(SUM(carts.quantity * wines.price * (100 - wine_sets.discount_rate) / 100)) AS total_price'))
		    ->where('carts.session_id', '=', session()->getId())
            ->first();

		$this->intWineTotal = ($objTmp->total_price + $objTmp2->total_price);
		session()->put('wine_total', $this->intWineTotal);
	}

	public function index(Request $request)
	{	
            $returnUrl    = '//anyway-grapes.jp/laravel5.3/public/cart';
            $fDisableEdit = session()->get('disable_cart_edit', false);
            $fLoggedIn    = (session()->get('user_id', false) && session()->get('user_name', false));

            $this->setWineCount();

            return view('carts.cart', array(
                'fDisableEdit' => $fDisableEdit,
                'fLoggedIn'    => $this->fLoggedIn,
                'returnUrl'    => $returnUrl,
                'rgobjWine'    => $this->getWines(),
                'intWineTotal' => $this->intWineTotal,
                'cTotalWine'   => $this->cWine
            ));
	}

        public function remove($barcode = null)
        {
            $sessionId = session()->getId();
            if ($barcode == null)
            {
                Cart::where('session_id', $sessionId)->delete();
            }
            else
            {
                Cart::where('session_id', $sessionId)
                ->where('product_id', $barcode)
                ->delete();
            }

            return "Trying to delete with ID: $sessionId";
        }

        public function update($barcode, $qty)
        {
            if (($barcode != null) && ($qty != null))
            {
                $sessionId = session()->getId();

                Cart::where('session_id', $sessionId)
                    ->where('product_id', $barcode)
                    ->update([ 'quantity' => $qty, 'date_modified' => DB::raw('now()') ]);

                return $sessionId;
            }
        }

        public function checkout()
        {
            $this->setWineCount();

            return view('carts.checkout', array(
                'rgobjWine' => $this->getWines()
            ));
        }

    public function delivery()
	{
        $this->setWineCount();

		return view('carts.delivery', array(
		    'rgobjWine' => $this->getWines()
		));
	}
}
