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
        $data['recaptcha_public_key'] = config_item('recaptcha_public_key');
        if(!$this->survey->isValid()) {
            $this->title[] = 'Error page';
            $view = 'error';
        } else {
            if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
                $result = is_valid_recaptcha($postData);
                if(!$result['error']) {
                    $result = $this->survey->isValidSubmit();
                    if(!$result['error']) {
                        $survey = $this->survey->buildSubmit($postData);
                        $this->survey->saveSubmit($survey);
                        $this->session->set_userdata('redirect_form', true);
                        $this->session->mark_as_flash('redirect_form');
                        $this->load->helper('url');
                        header('Location: /', true, 303);
                        die;
                    } else {
                        $data['errors'] = $result['message'];
                    }
                } else {
                    $data['errors'] = $result['message'];
                }
            }
        }
        $redirect_form = $this->session->flashdata('redirect_form');
        if($redirect_form) {
            $this->title[] = 'Thank you page';
            $view = 'thankyou';
        }
        $this->loadView('main/' . $view, $this->setViewData($data));
    }

}
