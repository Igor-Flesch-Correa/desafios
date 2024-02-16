<?php

class StringManipulator
{
    public function capitalizeString($str)
    {
        return ucfirst($str);
    }

    public function concatenateStrings($str1, $str2)
    {
        return $str1 . $str2;
    }

    public function countVowels($str)
    {
        return preg_match_all('/[aeiouAEIOU]/', $str);
    }
}
