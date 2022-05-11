<?php

namespace Fazle\CodingExample;

use Fazle\CodingExample\Model\Product;
use Tightenco\Collect\Support\Collection;

class App
{

    protected Collection $basket;

    protected Cart $cart;

    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        //initialise cart
        $this->cart = new Cart();
    }
    
    /**
     * add Basket
     *
     * @param  array $basket
     * @return void
     */
    public function addBasket(array $basket): void
    {
        $this->basket = collect($basket);
    }
    
    /**
     * build Cart
     *
     * @return void
     */
    public function buildCart(): void
    {
        $this->cart->addItems($this->basket);
    }

    public function cart(): Cart
    {
        return $this->cart;
    }
}
