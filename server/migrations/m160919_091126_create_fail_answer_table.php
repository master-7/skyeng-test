<?php

use yii\db\Migration;

/**
 * Handles the creation for table `fail_answer`.
 */
class m160919_091126_create_fail_answer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('fail_answer', [
                'id' => $this->primaryKey(),
                'test_id' => $this->integer()->notNull(),
                'data' => "JSON NOT NULL"
            ],
            "ENGINE=InnoDB DEFAULT CHARSET=UTF8"
        );

        $this->addForeignKey(
            "fk_error_table_to_test",
            "fail_answer",
            "test_id",
            "test",
            "id",
            "NO ACTION",
            "NO ACTION"
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('fail_answer');
    }
}
