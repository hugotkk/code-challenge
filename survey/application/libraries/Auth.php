<?php

class Auth {

    public $user = null;
    public $sess_key = 'auth';

    public function __contruct() {
        $this->load->database();
        var_dump($this->session[$this->sess_key]);
    }

    public function __get($field) {
        $ci = &get_instance();
        return $ci->{$field};
    }

    public function isAuth() {
        $user = $this->session->userdata($this->sess_key);
        return isset($user);
    }

    public function logout() {
        $this->session->unset_userdata($this->sess_key);
    }

    public function login($username , $password) {
        $salt = config_item('salt');
        $hash = sha1($salt . $password);
        $query = $this->db->query("select username from user where username = ? and password = ?", [$username, $hash]);
        $result = $query->result_array();
        if($result) {
            $user = $result[0];
            $this->session->set_userdata($this->sess_key, [
                'username' => $user['username'],
            ]);
            return true;
        }
        return false;
    }
}

