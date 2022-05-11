<?php

namespace Fazle\CodingExample\Model;

use Tightenco\Collect\Support\Collection;

class CartItem
{
    protected Product $product;
    protected int $qty;

    public function setProduct(Product $product): CartItem
    {
        $this->product = $product;
        return $this;
    }

    public function setQty(int $qty): CartItem
    {
        $this->qty = $qty;
        return $this;
    }

    public function product()
    {
        return $this->product;
    }

    public function qty()
    {
        return $this->qty;
    }

    public function getLineTotal(): int
    {
        return $this->qty * $this->product->unitPrice();
    }

    public function getSpecialPrice(Collection $cartItems): int
    {
        $price = 0;

        if ($this->product->hasSpecialPrice()) {
            $spcialPrices = $this->product->getSpecialPrice()->toArray();
            usort($spcialPrices, function ($a, $b) {
                return $b["number_of_items"] <=> $a["number_of_items"];
            });

            $qty = $this->qty;
            $tempQty = 0;
            foreach ($spcialPrices as $sp) {
                $noOfItem = (int) $sp["number_of_items"];
                if ($sp['type'] == "combined" && $qty >= $noOfItem) {
                    $tempQty = $qty % $noOfItem;
                    $multi = ($qty - $tempQty) /  $noOfItem;
                    $qty = $tempQty;
                    $price += $multi * (int) $sp["price"];
                } elseif ($sp['type'] == "linked" &&  $qty >= $noOfItem) {
                    $product = $cartItems->first(fn (CartItem $item) => $item->product->sku() === $sp["linked_product"]);
                    if ($product) {
                        $price = $qty * (int) $sp["price"];
                    }
                }
            }
            if ($tempQty > 0) {
                $price +=  ($tempQty * $this->product->unitPrice());
            }
        }
        return $price > 0 ? $price : $this->getLineTotal();
    }
}
