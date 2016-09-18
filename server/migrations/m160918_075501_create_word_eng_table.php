<?php

use yii\db\Migration;

/**
 * Handles the creation for table `word_eng`.
 */
class m160918_075501_create_word_eng_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('word_eng',
            [
                'id' => $this->primaryKey() . " AUTO_INCREMENT",
                'word' => $this->string()->notNull()
            ],
            "ENGINE=InnoDB DEFAULT CHARSET=UTF8"
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('word_eng');
    }
}
