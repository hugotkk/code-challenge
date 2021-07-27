<?php

class Migration_Survey extends CI_Migration {

    public function up() {
        $sql[] = <<< SQL
CREATE TABLE `survey` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` varchar(199) NULL,
`email` varchar(199) NULL,
`ip` varchar(199) NULL,
`user_agent` varchar(199) NULL,
`datetime` datetime NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8mb4_unicode_ci';
SQL;
        $sql[] = <<< SQL
CREATE TABLE `survey_colors` (
`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
`color` varchar(199) NULL,
`survey_id` int(11) NOT NULL,
FOREIGN KEY (`survey_id`) REFERENCES `survey` (`id`)
) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';
SQL;
        foreach($sql as $q) {
            $this->db->query($q);
        }
// Insert Sample Data
        $this->load->model('survey');
        $list_color = array_keys($this->survey->getColors());
        $list_agent = [
            'google',
            'chrome',
            'edge',
            'safari'
        ];
        $now = time();
        for($i = 0; $i < 1000; $i++) {
            $time = $now - rand(0, 2592000);
            $no_of_color = rand(1, 3);
            $colors = [];
            for($j = 0; $j < $no_of_color; $j++) {
                $colors[] = $list_color[array_rand($list_color)];
            }
            $user_agent = $list_agent[array_rand($list_agent)];
            $survey = [
                'name' => 'user' . $i,
                'email' => 'hugotkk' . $i . '@live.hk',
                'ip' => mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255),
                'user_agent' => $user_agent,
                'colors' => $colors,
                'datetime' => date('Y-m-d_H-i', $time)
            ];
            $this->survey->saveSubmit($survey);
        }
    }

    public function down() {
    }
}
