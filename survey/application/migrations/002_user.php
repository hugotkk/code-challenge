<?php

class Migration_user extends CI_Migration {

    public function up() {
        $sql[] = <<< SQL
CREATE TABLE `user` (
`id` int NOT NULL,
`username` varchar(199) NOT NULL,
`password` varchar(199) NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8mb4_general_ci';
SQL;
        $sql[] = <<< SQL
ALTER TABLE `user`
CHANGE `id` `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;
SQL;
        $salt = config_item('salt');
        for($i = 0; $i < 10; $i++) {
            $username = 'user'.$i;
            $hash = sha1($salt . $username . $i);
            $sql[] = <<< SQL
insert into `user`(username, password) VALUES ('$username', '$hash');
SQL;
        }
        foreach($sql as $q) {
            $this->db->query($q);
        }
    }

    public function down() {
    }
}
