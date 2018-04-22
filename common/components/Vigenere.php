<?php
namespace common\components;
/**
 * Created by PhpStorm.
 * User: fan
 * Date: 22/04/2018
 * Time: 9:56
 */
class Vigenere
{
    static function Mod($a, $b)
    {
        return ($a % $b + $b) % $b;
    }

    static function Cipher($input, $key, $encipher)
    {
        $keyLen = strlen($key);

        for ($i = 0; $i < $keyLen; ++$i)
            if (!ctype_alpha($key[$i]))
                return ""; // Error

        $output = "";
        $nonAlphaCharCount = 0;
        $inputLen = strlen($input);

        for ($i = 0; $i < $inputLen; ++$i) {
            if (ctype_alpha($input[$i])) {
                $cIsUpper = ctype_upper($input[$i]);
                $offset = ord($cIsUpper ? 'A' : 'a');
                $keyIndex = ($i - $nonAlphaCharCount) % $keyLen;
                $k = ord($cIsUpper ? strtoupper($key[$keyIndex]) : strtolower($key[$keyIndex])) - $offset;
                $k = $encipher ? $k : -$k;
                $ch = chr((Vigenere::Mod(((ord($input[$i]) + $k) - $offset), 26)) + $offset);
                $output .= $ch;
            } else {
                $output .= $input[$i];
                ++$nonAlphaCharCount;
            }
        }

        return $output;
    }

    static function Encipher($input, $key)
    {
        return Vigenere::Cipher($input, $key, true);
    }

    static function Decipher($input, $key)
    {
        return Vigenere::Cipher($input, $key, false);
    }

    static function random_str($length)
    {
        return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

}