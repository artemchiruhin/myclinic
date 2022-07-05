<?php
if (!function_exists('get_full_name')) {
    function get_full_name($person) {
        return $person->last_name . ' ' . $person->first_name . ' ' . $person->patronymic;
    }
}
if (!function_exists('get_declination_of_word')) {
    function get_declination_of_word($num, $titles) {
        $cases = array(2, 0, 1, 1, 1, 2);

        return $titles[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
    }
}
if (!function_exists('upper_first')) {
    function upper_first($str) {
        $fc = mb_strtoupper(mb_substr($str, 0, 1));
        return $fc.mb_substr($str, 1);
    }
}
if (!function_exists('get_name_with_initials')) {
    function get_name_with_initials($person) {
        return $person->last_name . ' ' . mb_substr($person->first_name, 0, 1) . '.' . ' ' . mb_substr($person->patronymic, 0, 1) . '.';
    }
}
