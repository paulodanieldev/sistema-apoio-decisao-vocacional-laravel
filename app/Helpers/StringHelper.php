<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class StringHelper
{
    /**
     * @param string $string,
     * @param array $characters
     * @return string
     */
    public static function removeCharacters(
        string $string,
        ?array $characters = ["/", ":", "-", "(", ")", " ", ";", ".", "*", "#"]
    ): string {

        $result = $string;
        foreach ($characters as &$character) $result = str_replace($characters, "", $string);

        return $result;
    }

    /**
     * @param string $str
     * @return string
     */
    public static function generateSlug($str)
    {
        $str = mb_strtolower($str);
        $str = preg_replace('/(â|á|ã)/', 'a', $str);
        $str = preg_replace('/(ê|é)/', 'e', $str);
        $str = preg_replace('/(í|Í)/', 'i', $str);
        $str = preg_replace('/(ú)/', 'u', $str);
        $str = preg_replace('/(ó|ô|õ|Ô)/', 'o', $str);
        $str = preg_replace('/(_|\/|!|\?|#)/', '', $str);
        $str = preg_replace('/( )/', '-', $str);
        $str = preg_replace('/ç/', 'c', $str);
        $str = preg_replace('/(-[-]{1,})/', '-', $str);
        $str = preg_replace('/(,)/', '-', $str);
        $str = preg_replace('/(\.)/', '-', $str);
        $str = preg_replace('/(\')/', '-', $str);
        $str = preg_replace('~[^\pL\d]+~u', '-', $str);
        $str = iconv('utf-8', 'us-ascii//TRANSLIT', $str);
        $str = preg_replace('~[^-\w]+~', '', $str);
        $str = trim($str, '-');
        $str = preg_replace('~-+~', '-', $str);
        $str = strtolower($str);

        if (empty($str)) {
            return 'n-a';
        }

        return $str;
    }

    /**
     * @return string
     */
    public static function generateCheckoutSlug(): string
    {
        return md5(uniqid(rand(), true));
    }

    public static function formatMainAddressText($street, $number)
    {
        $formattedStreet = $street ?? "";
        $formattedNumber = $number ? ", {$number}" : "";

        $formattedText = "{$formattedStreet}{$formattedNumber}";
        return $formattedText;
    }

    public static function formatSecondaryAddressText($district, $city, $state, $country)
    {
        $formattedDistrict = $district ??  "";
        $formattedCity = $city ? ", {$city}" : "";
        $formattedState = $state ? " - {$state}" : "";
        $formattedCountry = $country ? ", {$country}" : "";

        $formattedText = "{$formattedDistrict}{$formattedCity}{$formattedState}{$formattedCountry}";
        return $formattedText;
    }

    public static function formatAddress($mainText, $secondaryText): string
    {
        $formattedText = "{$mainText} - {$secondaryText}";
        return $formattedText;
    }

    public static function formatStorageFileUrl(?string $file = NULL, ?string $folderPath = "restaurantes/pages/")
    {
        if ($file) {
            $publicUrl = Config::get('filesystems.public_url');
            $baseUrl = "{$publicUrl}{$folderPath}";

            $response = "{$baseUrl}{$file}";

            return $response;
        }

        return $file;
    }

    /**
     * @param int $storeId
     * @param int $userId
     * @param int $purchaseId
     * @return string
     */
    public static function generateCode(int $storeId, int $userId, int $purchaseId): string
    {
        $year = Carbon::now()->format('Y');
        $code = "RF{$storeId}{$year}{$purchaseId}{$userId}";

        return $code;
    }
    /**
     * @param string $tel
     * @return string
     */
    public static function sanitizePhoneNumber(string $tel): string 
    {
        $tel = preg_replace("/[^0-9]/", "", $tel);
        $tel = (substr($tel, 0, 2) == '55' && strlen($tel) > 12) ? substr($tel, 2) : $tel;
    
        return $tel;
    }    

    /**
     * @param string $phrase
     * @return bool
     */
    public static function hasNumericCharacter(string $phrase): bool
    {
        $isThereNumber = preg_match('~[0-9]+~', $phrase);

        return $isThereNumber;
    }
}
