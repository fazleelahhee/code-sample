<?php

namespace Fazle\CodingExample;

use Fazle\CodingExample\Model\CartItem;
use Fazle\CodingExample\Model\Product;
use Tightenco\Collect\Support\Collection;

/**
 * Cart
 */
class Cart
{

    private Collection $items;

    public function __construct()
    {
        $this->items = new Collection();
    }
        
    /**
     * add Item
     *
     * @param  string $sku
     * @param  int $qty
     * @return Cart
     */
    public function addItem(String $sku, int $qty): Cart
    {
        $product = Product::all()->first(fn ($item) => $item->sku() === $sku);
        $cartItem = new CartItem();
        $cartItem->setProduct($product);
        $cartItem->setQty($qty);
        $this->items->add($cartItem);

        return $this;
    }
    
    /**
     * add Items
     *
     * @param  Collection $basket
     * @return Cart
     */
    public function addItems(Collection $basket): Cart
    {
        $basket->map(fn($item) => $this->addItem($item['sku'], $item['qty']));
        return $this;
    }

    
    /**
     * get Cart Items
     *
     * @return Collection
     */
    public function getCartItems(): Collection
    {
        return $this->items;
    }
    
    /**
     * get Sub Total
     *
     * @return int
     */
    public function getSubTotal(): int
    {
        return $this->items->reduce(fn(int $prevState, CartItem $item) => $prevState += $item->getLineTotal(), 0);
    }
    
    /**
     * special Offer Discount
     *
     * @return int
     */
    public function getSpecialOffer(): int
    {
        return $this->items->reduce(fn(int $prevState, CartItem $item) => $prevState += $item->getSpecialPrice($this->items), 0);
    }

    public function discount() : int
    {
        return $this->getSubTotal() - $this->getSpecialOffer();
    }
}
