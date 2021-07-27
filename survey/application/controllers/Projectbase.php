<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectbase extends CI_Controller {

    public $title = [];

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->title[] = 'DF Coding Challenge';
    }

    public function setViewData($data) {
        $data['title'] = implode(' | ', array_reverse($this->title));
        return $data;
    }

    public function loadView($view, $data) {
        $viewData = $this->setViewData($data);
        $this->load->view('common/header.php', $viewData);
        $this->load->view('common/footer', $viewData);
        $this->load->view($view, $viewData);
    }

}
