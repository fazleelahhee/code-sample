<?php

namespace Fazle\CodingExampleTests;

use Fazle\CodingExample\Cart;
use Fazle\CodingExample\Model\Product;
use PHPUnit\Framework\TestCase;

final class CartTest extends TestCase 
{
    protected $cart;
    
    protected function setUp(): void
    {
        $productConfig = require_once __DIR__ . "/../config.php";
        Product::init($productConfig);
        $this->cart = new Cart;
        $this->cart->addItems(collect([
            [
                "sku" => "A",
                "qty" => 3
            ],
            [
                "sku" => "B",
                "qty" => 2
            ],
            [
                "sku" => "C",
                "qty" => 5
            ],
            [
                "sku" => "D",
                "qty" => 1
            ],
            [
                "sku" => "E",
                "qty" => 1
            ],
        ]));
    }


    public function testIsCalculateValidSpecialPrice(): void {
        $this->assertEquals(273, $this->cart->getSpecialOffer());
    }

}
