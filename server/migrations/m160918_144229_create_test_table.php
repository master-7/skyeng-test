<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test`.
 */
class m160918_144229_create_test_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test',
            [
                'id' => $this->primaryKey() . " AUTO_INCREMENT",
                'username' => $this->string()->notNull(),
                'evaluation' => $this->integer(2)
            ],
            "ENGINE=InnoDB DEFAULT CHARSET=UTF8"
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test');
    }
}
