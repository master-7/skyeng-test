<?php

use yii\db\Migration;

/**
 * Handles the creation for table `word_ru`.
 */
class m160918_075456_create_word_ru_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('word_ru',
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
        $this->dropTable('word_ru');
    }
}
