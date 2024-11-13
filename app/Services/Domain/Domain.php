<?php

namespace App\Services\Domain;

class Domain {
    public $name;   
    public $price;
    public $discount;

    protected $pricesMap = [
        '.net' => 350000,
        '.com' => 300000,
        '.org' => 450000,
        '.vn' => 700000,
        '.store' => 500000,
        '.one' => 800000,
        '.pics' => 780000,
        '.cloud' => 900000,
        '.asis' => 400000,
        '.monster' => 560000,
        '.group' => 590000,
        '.info' => 480000,
        '.help' => 340000,
        '.xyz' => 800000,
        '.cc' => 900000,
    ];

    protected const PRICES_MAP = [
        '.net' => 350000,
        '.com' => 300000,
        '.org' => 450000,
        '.vn' => 700000,
        '.store' => 500000,
        '.one' => 800000,
        '.pics' => 780000,
        '.cloud' => 900000,
        '.asis' => 400000,
        '.monster' => 560000,
        '.group' => 590000,
        '.info' => 480000,
        '.help' => 340000,
        '.xyz' => 800000,
        '.cc' => 900000,
    ];

    protected $discountsMap = [
        '.net' => 12,
        '.com' => 5,
        '.org' => 30,
        '.vn' => 50,
        '.store' => 11,
        '.one' => 2,
        '.pics' => 5,
        '.cloud' => 35,
        '.asis' => 39,
        '.monster' => 4,
        '.group' => 6,
        '.info' => 7,
        '.help' => 8,
        '.xyz' => 9,
        '.cc' => 10,
    ];

    public static function newDefault($name)
    {
        $newDomain = new self();

        $newDomain->name = $name;

        $suffix = $newDomain->getSuffix($name);

        $newDomain->price = $newDomain->getPriceFromSuffix($suffix);
        $newDomain->discount = $newDomain->getDiscountPercentBySuffix($suffix);

        return $newDomain;
    }

    public static function getPrices()
    {
        return self::PRICES_MAP;
    }

    private function getSuffix($domain) {
        $host = parse_url($domain, PHP_URL_HOST) ?: $domain;
        $parts = explode('.', $host);
        
        if (count($parts) > 1) return '.' . end($parts);

        return null;
    }

    private function getDiscountPercentBySuffix($suffix)
    {
        if (!$suffix) return 0;

        return $this->discountsMap[$suffix];
    }

    private function getPriceFromSuffix($suffix)
    {
        if (!$suffix) return 0;
        if (!$this->pricesMap[$suffix]) return 500000;

        return $this->pricesMap[$suffix];
    }
}