<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectbase extends CI_Controller {

    public $title = [];

    public function __construct() {
        parent::__construct();
        $this->title[] = 'DF Coding Challenge';
    }

    public function setViewData($data) {
        $data['title'] = implode(' | ', array_reverse($this->title));
        return $data;
    }

}
