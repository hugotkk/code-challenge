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

if (!function_exists('is_valid_recaptcha')) {
    function is_valid_recaptcha($postData) {
        $secret = config_item('recaptcha_private_key');
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->verify(may_blank($postData['g-recaptcha-response']));
        if ($resp->isSuccess()) {
            $result['error'] = false;
            $result['message'] = '';
        } else {
            $result['error'] = true;
            $result['message'] = 'Failed to pass the reCAPTCHA: '. implode('<br/>', $resp->getErrorCodes());
        }
        return $result;
    }
}
