<?php

namespace App\Services\Domain;

use App\Helpers\Functions;

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

    public function isAvalaible()
    {
        $name = $this->name;

        return Functions::isDomainAvailable($name);
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

    public function isValidNameFormat(): bool
    {
        $pattern = '/^(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';

        return preg_match($pattern, $this->name) === 1;
    }

    public function isAvailable(): bool
    {
        if (!$this->isValidNameFormat()) return false;

        // Thêm tiền tố http nếu chưa có
        if (!preg_match("~^(?:f|ht)tps?://~i", $this->name)) {
            $this->name = "http://" . $this->name;
        }

        // Khởi tạo cURL
        $ch = curl_init($this->name);

        // Thiết lập cURL -> chỉ kiểm tra trạng thái mà không tải nội dung
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);  // Giới hạn thời gian chờ là 10 giây
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Theo dõi chuyển hướng nếu có

        curl_exec($ch);

        // Lấy mã trạng thái HTTP
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // 200–399 -> tên miền tồn tại
        return !($httpCode >= 200 && $httpCode < 400);
    }
}