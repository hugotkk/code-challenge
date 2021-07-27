<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Projectbase.php');
class Main extends Projectbase {

    public function index()
    {
        $this->title[] = 'Survey 2021';
        $this->load->model('survey');
        $data = [];
        $view = 'index';
        $postData = $this->input->post();
        $data['post_data'] = $this->survey->getPostData($postData);
        $data['colors'] = $this->survey->getColors();
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
            $result = $this->survey->isValidSubmit();
            if(!$result['error']) {
                $survey = $this->survey->buildSubmit($postData);
                $this->survey->saveSubmit($survey);
                $this->title[] = 'Thank you page';
                $view = 'thankyou';
            } else {
                $data['errors'] = $result['message'];
            }
        }
        $this->load->view('main/' . $view, $this->setViewData($data));
    }

}
