<?php

use yii\db\Migration;

class m170119_170622_tbl_advert extends Migration
{
    public function up()
    {
        $this->execute("
                CREATE TABLE `advert` (
          `id` int(11) NOT NULL,
          `price` mediumint(11) DEFAULT NULL,
          `address` varchar(255) DEFAULT NULL,
          `fk_agent` mediumint(11) DEFAULT NULL,
          `bedroom` smallint(1) DEFAULT NULL,
          `livingroom` smallint(1) NOT NULL,
          `parking` smallint(1) NOT NULL,
          `kitchen` smallint(1) NOT NULL,
          `general_image` varchar(200) NOT NULL,
          `description` text NOT NULL,
          `location` varchar(30) NOT NULL,
          `hot` smallint(1) NOT NULL,
          `sold` smallint(1) NOT NULL,
          `type` varchar(50) NOT NULL,
          `recommended` smallint(1) NOT NULL,
          `created_at` int(11) NOT NULL,
          `updated_at` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    public function down()
    {
        $this->dropTable('advert');

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
