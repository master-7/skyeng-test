<?php

use yii\db\Migration;

/**
 * Handles the creation for table `relation`.
 */
class m160918_075514_create_relation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('relation',
            [
                'ru' => $this->integer(),
                'eng' => $this->integer(),
                'PRIMARY KEY(ru, eng)'
            ],
            "ENGINE=InnoDB DEFAULT CHARSET=UTF8"
        );

        $this->addForeignKey(
            "fk_relation_table_to_word_ru",
            "relation",
            "ru",
            "word_ru",
            "id",
            "CASCADE",
            "CASCADE"
        );

        $this->addForeignKey(
            "fk_relation_table_to_word_eng",
            "relation",
            "eng",
            "word_eng",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('relation');
    }
}
