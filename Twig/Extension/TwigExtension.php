<?php

namespace Acme\HelloBundle\Twig\Extension;
use Acme\HelloBundle\Entity\Product;

class TwigExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
			'discountFilter' => new \Twig_Function_Method($this, 'discountFilter'));
        
	}
	public function discountFilter( $price, $discount)
    {
        $price = $price - $price*$discount/100;
        return $price;
    }
	
//nombre de nuestra extension
    public function getName()
    {
        return 'mytwig';
    }
}