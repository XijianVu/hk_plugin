<?php

namespace App\Helpers;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\Domain\Domain;

class Functions 
{
    private const MAX_SUGGEST = 6;
    
    private const LTDS = [
        '.com',       // Ưu tiên cao nhất
        '.com.vn',    // Thứ tự ưu tiên tiếp theo
        '.vn',
        '.info',
        '.org',
        '.net',
        '.store',
        '.one',
        '.pics',
        '.cloud',
        '.asis',
        '.monster',
        '.group',
        '.help',
        '.xyz',
        '.cc'
    ];

    private const WORDS_LIST = [
        'tech',
        'online',
        'digital',
        'web',
        'solution',
        'cloud',
        'app',
        'nhahang',
        'haisan',
        'chienthuat',
        'laptrinh',
        'nauan',
        'daubep',
        'hinhanh',
        'batlua',
        'duhoc',
        'daotao',
        'hochoi',
        'xyz',
        'abc',
        'sanchoi',
        'thuongmai',
        'shopping',
        'dientu',
        'sachvo',
        'teaching',
        'coder',
        'levi',
        'thethao',
        'quanao',
        'maytinh',
        'dienthoai',
        'caycanh',
        'cacanh',
        'vatnuoi',
        'chongluadao',
        'anninh',
        'anninhmang',
        'phothong'
    ];

    private const SUGGEST_SUFFIX = ['123', 'xyz', 'abc', 'vip', 'top', 'pro', 'ngon', 'ok', 'one', 'good', 'tot'];

    public static function isValidDomainFormat($domain): bool
    {
        $pattern = '/^(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';

        return preg_match($pattern, $domain) === 1;
    }

    public static function isDomainAvailable($domain): bool
    {
        // Thêm tiền tố http nếu chưa có
        if (!preg_match("~^(?:f|ht)tps?://~i", $domain)) {
            $domain = "http://" . $domain;
        }

        // Khởi tạo cURL
        $ch = curl_init($domain);

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

    public static function getSuggestDomains($searchValue = null)
    {
        if ($searchValue === null) {
            $availableDomains = self::getAvailableDomains();

            return $availableDomains;
        }

        return self::generateDomainsBasedOnSearch($searchValue);
    }

    public static function isDomainAvailableMulti($domains)
    {
        $multiCurl = curl_multi_init();
        $curlHandles = [];

        // Thiết lập các phiên curl
        foreach ($domains as $domain) {
            $domain = (preg_match("~^(?:f|ht)tps?://~i", $domain)) ? $domain : "http://" . $domain;

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $domain,
                CURLOPT_NOBODY => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT_MS => 5000, // Giảm thời gian timeout xuống còn 5 giây
                CURLOPT_FOLLOWLOCATION => true,
            ]);

            curl_multi_add_handle($multiCurl, $ch);
            $curlHandles[$domain] = $ch;
        }

        $running = null;

        // Thực hiện các yêu cầu song song
        do {
            $status = curl_multi_exec($multiCurl, $running);
            if ($status > 0) {
                break; // Nếu có lỗi, thoát sớm
            }
            // Tránh block bởi curl_multi_select
            while (curl_multi_select($multiCurl, 0.1) === 0);
        } while ($running);

        $results = [];

        // Lấy kết quả từ từng yêu cầu
        foreach ($curlHandles as $domain => $ch) {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $results[$domain] = !($httpCode >= 200 && $httpCode < 400);

            curl_multi_remove_handle($multiCurl, $ch);
            curl_close($ch);
        }

        curl_multi_close($multiCurl);

        return $results;
    }

    private static function getAvailableDomains()
    {
        $suggestedDomains = [];
        $maxAttempts = 20;
        $batchSize = 30; // Tăng số lượng domain kiểm tra mỗi batch
        $checkedDomains = [];

        for ($attempts = 0; $attempts < $maxAttempts && count($suggestedDomains) < self::MAX_SUGGEST; $attempts++) {
            // Sinh batch domain
            $domainCandidates = array_unique(array_map(
                fn() => self::generateRandomDomain(self::WORDS_LIST, self::LTDS),
                range(1, $batchSize)
            ));

            // Loại bỏ domain đã kiểm tra trước đó
            $domainCandidates = array_diff($domainCandidates, $checkedDomains);
            $checkedDomains = array_merge($checkedDomains, $domainCandidates);

            // Kiểm tra khả dụng với DNS lookup
            foreach ($domainCandidates as $domain) {
                if (self::isDomainAvailableByDNS($domain)) {
                    $suggestedDomains[] = Domain::newDefault($domain);
                    if (count($suggestedDomains) >= self::MAX_SUGGEST) {
                        return $suggestedDomains; // Đạt số lượng yêu cầu, thoát sớm
                    }
                }
            }
        }

        // Nếu chưa đủ, thêm domain bằng hậu tố
        while (count($suggestedDomains) < self::MAX_SUGGEST) {
            $newDomain = self::addSuffixToDomain($suggestedDomains);
            if (!in_array($newDomain, $checkedDomains) && self::isDomainAvailableByDNS($newDomain)) {
                $suggestedDomains[] = Domain::newDefault($newDomain);
                $checkedDomains[] = $newDomain;
            }
        }

        return $suggestedDomains;
    }

    private static function isDomainAvailableByDNS($domain): bool
    {
        // Chỉ kiểm tra các bản ghi A hoặc MX của domain
        return !checkdnsrr($domain, 'A') && !checkdnsrr($domain, 'MX');
    }

    private static function generateRandomDomain($wordList, $tlds)
    {
        $randomWord = $wordList[array_rand($wordList)];
        $randomTld = $tlds[array_rand($tlds)];

        return $randomWord . $randomTld;
    }

    private static function generateDomainsBasedOnSearch($searchValue)
    {
        $suggestedDomains = [];
        
        // Kiểm tra nếu searchValue là domain hợp lệ, thì giữ nguyên phần tên miền trước dấu "."
        if (self::isValidDomainFormat($searchValue)) {
            // Nếu là domain hợp lệ, chỉ lấy phần trước dấu "."
            $baseName = explode('.', $searchValue)[0];
        } else {
            // Nếu không phải là domain hợp lệ, bỏ ký tự đặc biệt và giữ lại phần tên
            $baseName = preg_replace('/[^a-zA-Z0-9]/', '', $searchValue);
        }

        // Lặp qua các đuôi tên miền và tạo ra các tên miền gợi ý
        foreach (self::LTDS as $tld) {
            $newDomain = $baseName . $tld;

            // Kiểm tra nếu tên miền gợi ý không trùng với searchValue và tên miền có thể đăng ký
            if ($newDomain !== $searchValue && self::isDomainAvailable($newDomain)) {
                $suggestedDomains[] = Domain::newDefault($newDomain);
            }

            // Dừng lại nếu đã tìm được đủ 4 domain
            if (count($suggestedDomains) >= 4) {
                break;
            }
        }

        // Nếu chưa đủ 4 domain, thử thêm hậu tố vào các domain đã có
        while (count($suggestedDomains) < self::MAX_SUGGEST) {
            $newDomain = self::addSuffixToDomain($suggestedDomains);
            if (self::isDomainAvailable($newDomain)) {
                $suggestedDomains[] = Domain::newDefault($newDomain);
            }
        }

        return $suggestedDomains;
    }

    private static function addSuffixToDomain($suggestedDomains)
    {
        $lastDomain = $suggestedDomains[count($suggestedDomains) - 1]->name;
        $baseName = explode('.', $lastDomain)[0];
        $randomSuffix = self::SUGGEST_SUFFIX[array_rand(self::SUGGEST_SUFFIX)];

        return $baseName . $randomSuffix . '.' . explode('.', $lastDomain)[1];
    }

    public static function convertStringPriceToNumber($strPrice)
    {
        if (is_numeric($strPrice) && floatval($strPrice) > 0) { 
            return floatval($strPrice);
        }

        if (!is_string($strPrice)) return 0;

        $cleanStr = str_replace(array(',', '.'), '', $strPrice);
        $floatNum = floatval($cleanStr);

        return $floatNum;
    }

    public static function formatNumberToVnd($number, $decimals = 0)
    {
        // Check if the number is already rounded to 0 decimal places
        if ($number == round($number)) {
            // The number is already rounded
            $decimals = 0;
        }

        return number_format($number, $decimals, ".", ",");
    }
}

