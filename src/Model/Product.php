<?php

namespace Fazle\CodingExample\Model;

use Tightenco\Collect\Support\Collection;

class Product
{
    protected static Collection $items;
    protected string $name;
    protected string $sku;
    protected int $price;
    protected Collection $specialPrice;

    public function __construct(array $product)
    {
        $this->name = $product["name"];
        $this->sku = $product["SKU"];
        $this->price = $product["UnitPrice"];
        $this->specialPrices = collect($product["SpecialPrice"]);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function sku(): string
    {
        return $this->sku;
    }

    public function unitPrice(): int
    {
        return $this->price;
    }

    public function hasSpecialPrice(): bool
    {
        return count($this->specialPrices) > 0;
    }

    public function getSpecialPrice(): Collection
    {
        return $this->specialPrices;
    }

    public static function all(): Collection
    {
        return static::$items;
    }

    public static function init(array $productConfig): void
    {
        static::$items = new Collection();
        foreach ($productConfig as $item) {
            static::$items->add(new Product($item));
        }
    }
}
