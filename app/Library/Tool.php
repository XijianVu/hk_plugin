<?php

namespace App\Library;

class Tool
{
    public static function extractPhoneNumber($string) {
        // Use preg_replace to remove all non-numeric characters
        $phone = preg_replace('/\D/', '', trim($string));
        
        // // Số có 9 chữ số mà không có số 0 ở đầu, thêm số 0 ở đầu
        // if (strlen($phone) == 9 && $phone[0] != '0') {
        //     $phone = '0' . $phone;
        // }

        return $phone;
    }

    public static function getLastNineNumberOfPhone($string) {
        $phone = self::extractPhoneNumber($string);

        // Check if the string is shorter than 9 characters
        if (strlen($phone) <= 9) {
            return $phone;
        }
    
        // Get the last 9 characters
        return substr($phone, -9);
    }
}
