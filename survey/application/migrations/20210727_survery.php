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
`daetime` datetime NOT NULL
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
    }

    public function down() {
    }
}
