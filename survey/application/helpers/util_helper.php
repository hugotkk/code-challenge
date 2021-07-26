<?php

if (!function_exists('may_blank')) {
    function may_blank(&$val, $blank = '') {
        return (!isset($val) || $val === '' ? $blank : $val);
    }
}

if (!function_exists('limit_colors')) {
    function limit_colors() {
        $ci = & get_instance();
        $colors = $ci->input->post('colors');
        if(count($colors) > 3) {
            return false;
        } else {
            return true;
        }
    }
}
