<?php

class Survey extends CI_Model {


    public function getPostData($postData = []) {
        $data = [];
        $data['email'] = may_blank($postData['email'], '');
        $data['name'] = may_blank($postData['name'], '');
        $data['colors'] = may_blank($postData['colors'], []);
        return $data;
    }

    public function getColors() {
        return [
            'The-Vast-of-Night' => [
                'color' => '#110463',
                'name' => 'The Vast of Night',
            ],
            'Blue-Dacnis' => [
                'color' => '#46d5f2',
                'name' => 'Blue Dacnis',
            ],
            'Liberator-Gold' => [
                'color' => '#e5c347',
                'name' => 'Liberator Gold',
            ],
            'Prehnite-Yellow' => [
                'color' => '#d3a900',
                'name' => 'Prehnite Yellow',
            ],
            'Orchid' => [
                'color' => '#7584f9',
                'name' => 'Orchid',
            ],
            'Hollandaise' => [
                'color' => '#ffe83f' ,
                'name' => 'Hollandaise',
            ],
            'Casting-Sea' => [
                'color' => '#4288ce',
                'name' => 'Casting Sea',
            ],
            'Traditional-Royal-Blue' => [
                'color' => '#0701af',
                'name' => 'Traditional Royal Blue',
            ],
            'Yellow-Salmonberry' => [
                'color' => '#fcf17b',
                'name' => 'Yellow Salmonberry',
            ],
            'Blue Martina' => [
                'color' => '#10d1cd',
                'name' => 'Blue Martina',
            ],
        ];
    }

    public function isValidSubmit() {
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        $config = [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => implode('|', [
                    'is_unique[survey.email]',
                    'trim',
                    'required',
                    'valid_email',
                    'max_length[255]',
                ]),
            ],
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => implode('|', [
                    'trim',
                    'required',
                    'max_length[255]',
                ]),
            ],
            [
                'field' => 'colors[]',
                'label' => 'Favourite Colors',
                'rules' => implode('|', [
                    'trim',
                    'required',
                    'in_list['.implode(',', array_keys($this->getColors())).']',
                    'limit_colors',
                ]),
                'errors' => [
                    'limit_colors' => 'Only max 3 Favourite Colors can be selected.',
                ],
            ],
        ];
        $this->form_validation->set_rules($config);
        $result = [
            'error' => true,
            'message' => '',
        ];
        $result['error'] = !$this->form_validation->run();
        $result['message'] = validation_errors();
        return $result;
    }

    public function buildSubmit($postData) {
        $data = [];
        $data['name'] = may_blank($postData['name']);
        $data['email'] = may_blank($postData['email']);
        $data['colors'] = may_blank($postData['colors'], []);
        $ip = $this->input->ip_address();
        $data['ip'] = may_blank($ip);
        $user_agent = user_agent();
        $data['user_agent'] = may_blank($user_agent, '');
        return $data;
    }

    public function saveSubmit($data) {
        $this->db->trans_start();
        $this->db->query("insert into survey (name, email, ip, user_agent) VALUES (?, ?, ?, ?)", [
            $data['name'],
            $data['email'],
            $data['ip'],
            $data['user_agent'],
        ]);
        $survey_id = $this->db->insert_id();
        foreach($data['colors'] as $color) {
            $this->db->query("insert into survey_colors (survey_id, color) VALUES (?, ?)", [
                $survey_id,
                $color,
            ]);
        }
        $this->db->trans_complete();
    }

    public function isValid() {
        $query = $this->db->query("select count(1) as count from survey");
        $result = $query->result_array();
        if($result) {
            return $result[0]['count'] <= config_item('max_entry');
        }
        return true;
    }


}
