<?php

namespace App\Services;

class CartService
{
	private $cGoods;
	private $cWineSet;
	private $cFortuneBox;
    private $intShippingFee;
	private $intCoolFee;
    private $intWineTotal;

    public function __construct()
	{
        $this->cGoods         = -1;                                                                                                                                           
        $this->cWineSet       = -1;                                                                                                                                           
        $this->cFortuneBox    = -1;
		$this->intShippingFee = 0;
		$this->intCoolFee     = 0;
		$this->intWineTotal   = 0;
        
	    if (session()->has('shipping_fee'))
		{
			$this->intShippingFee = session()->get('shipping_fee');
		}

	    if (session()->has('cool_fee'))
		{
			$this->intCoolFee = session()->get('cool_fee');
		}

	    if (session()->has('wine_total'))
		{
			$this->intWineTotal = session()->get('wine_total');
		}
	}

    private function getTotalWithoutTax()
	{
		 return ($this->intShippingFee + $this->intCoolFee + $this->intWineTotal);
	}

    private function getPriceAsText($intPrice)
	{
		return (number_format($intPrice) . ' yen');
	}

	public function getTax()
	{
        return floor(0.08 * $this->getTotalWithoutTax());
	}
	
	public function getGrandTotal()
	{
		return ($this->getTotalWithoutTax() + $this->getTax());
	}

    public function getWineTotalAsText()
	{
		return $this->getPriceAsText($this->intWineTotal);
	}

    public function getShippingFeeAsText()
	{
		return $this->getPriceAsText($this->intShippingFee);
	}

    public function getCoolFeeAsText()
	{
		return $this->getPriceAsText($this->intCoolFee);
	}

    public function getTaxAsText()
	{
		return $this->getPriceAsText($this->getTax());
	}

    public function getGrandTotalAsText()
	{
		return $this->getPriceAsText($this->getGrandTotal());
	}

    public function getGoodsCount()
	{
		if ($this->cGoods < 0)
		{
			$this->cGoods = 0;
			
//prepareNextQuery($dbc);                                                                                                                                              
//$tmpResult = mysqli_query($dbc, "CALL get_cart_goods_count('$userId')");                                                                                             
//if ($tmpResult !== FALSE)                                                                                                                                            
//{                                                                                                                                                                    
//    list($cGoods) = mysqli_fetch_array($tmpResult);                                                                                                                  
//    mysqli_free_result($tmpResult);                                                                                                                                  
//} 
		}

        return $this->cGoods;
	}

    public function getWineSetCount()
	{
		if ($this->cWineSet < 0)
		{
			$this->cWineSet = 0;

//prepareNextQuery($dbc);                                                                                                                                              
//$tmpResult = mysqli_query($dbc, "CALL get_cart_set_count('$userId')");                                                                                               
//if ($tmpResult !== FALSE)                                                                                                                                            
//{
//    list($cWineSet) = mysqli_fetch_array($tmpResult);
//    mysqli_free_result($tmpResult);                                                                                                                                  
//}   
		}

        return $this->cWineSet;
	}

    public function getFortuneBoxCount()
	{
		if ($this->cFortuneBox < 0)
		{
			$this->cFortuneBox = 0;

//prepareNextQuery($dbc);
//$tmpResult = mysqli_query($dbc, "CALL get_cart_fortune_box_count('$userId')");
//if ($tmpResult !== FALSE)                                                                                                                                            
//{                                                                                                                                                                    
//    list($cFortuneBox) = mysqli_fetch_array($tmpResult);                                                                                                             
//    mysqli_free_result($tmpResult);                                                                                                                                  
//}                                                                                                                                                               
		}

        return $this->cFortuneBox;
	}

	public function getPrice($objWine)                                                                                                                                           
    {
		$price = $objWine->price;
		
        if (session()->has('user_id') &&                                                                                                               
            session()->has('user_name'))
	    {
            if (($objWine->member_price > 0) && ($objWine->member_price < $price))
            {
                $price = $objWine->member_price;
			}
        }

	    return $price;
    }

    public function getFreeShippingPrice()
	{
		$intPrice = 15000;
		if (session()->has('user_id') &&
            session()->has('user_name'))
	    {
	        $intPrice = 20000;
        }

        return $intPrice;
	}

	public function generatePriceHtml($objWine)                                                                                                                                  
    {           
        return (number_format($this->getPrice($objWine)) . ' yen');                                                                                                              
    }
	
	public function getDeliveryBoxCount($intQty)                                                                                                                                
    {
        $intBox = intval($intQty / 12, 10);
        if (($intQty % 12) > 0)
        {
            ++$intBox;
		}

        return $intBox;
	}

    public function getFreeBoxCount($intTotal, $intQty)
    {
        $cFreeBox = floor($intTotal / $this->getFreeShippingPrice());
		
		return min($cFreeBox, $this->getDeliveryBoxCount($intQty));                                                                                                                
    }

    public function canCheckout()
	{
		return true;
	}
}