<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Projectbase.php');
class Report extends Projectbase {


    public function __construct() {
        parent::__construct();
        $this->load->library('auth');
    }

    public function login() {
        $data = [];
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if($this->auth->login($username, $password)) {
                header('Location: /report', true, 303);
                die;
            } else {
                $data['errors'] = 'Username / Password is not correct.';
            }
        }
        $this->loadView('report/login', $this->setViewData($data));
    }

    public function logout() {
        $this->auth->logout();
        header('Location: /report/login');
        exit;
    }

    public function index()
    {
        if(!$this->auth->isAuth()) {
            header('Location: /report/login', true);
            exit;
        }
        $this->title[] = 'Report for survery 2021';
        $data = [];
        $this->loadView('report/index', $this->setViewData($data));
    }

    public function bar_graph() {
        $data = [];
        $this->loadView('report/bar_graph', $this->setViewData($data));
    }

    public function entries_per_color() {
        $data = [];
        $this->loadView('report/entries_per_color', $this->setViewData($data));
    }

    public function full_logs($page = 1) {
        $data = [];
        $this->load->model('survey');
        if(!$page) {
            $page = 1;
        }
        if(!preg_match('#\d+#', $page)) {
            show_404();
        }
        $item_per_page = 100;
        $result = $this->survey->getFullLogs($page, $item_per_page);
        $data['page'] = $page;
        $data['rows'] = $result['data'];
        if(!$data['rows'] && $page != 1) {
            show_404();
        }

        $this->load->library('pagination');
        $config['base_url'] = '/report/full-logs/page';
        $config['total_rows'] = $result['total'];
        $config['use_page_numbers'] = TRUE;
        $config['per_page'] = $item_per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->loadView('report/full_logs', $this->setViewData($data));
    }

}
