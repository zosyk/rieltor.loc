<?php

use yii\db\Migration;

class m170119_171049_tbl_subscribe extends Migration
{
    public function up()
    {
        $this->execute("
                CREATE TABLE `subscribe` (
              `id` int(11) NOT NULL,
              `email` varchar(45) DEFAULT NULL,
              `date_subscribe` date DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    public function down()
    {
        $this->dropTable('subscribe');

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
