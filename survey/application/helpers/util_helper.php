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

if (!function_exists('user_agent')) {
    function user_agent() {
        $ci = & get_instance();
        $ci->load->library('user_agent');
        if ($ci->agent->is_browser()) {
            $agent = $ci->agent->browser().' '.$ci->agent->version();
        } elseif ($ci->agent->is_robot()) {
            $agent = $ci->agent->robot();
        } elseif ($ci->agent->is_mobile()) {
            $agent = $ci->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        return $agent;
    }
}
