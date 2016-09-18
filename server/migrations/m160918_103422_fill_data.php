<?php

use yii\db\Migration;

class m160918_103422_fill_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->batchInsert(
            "word_ru",
            ["id", "word"],
            [
                [1, "яблоко"],
                [2, "персик"],
                [3, "апельсин"],
                [4, "виноград"],
                [5, "лимон"],
                [6, "ананас"],
                [7, "арбуз"],
                [8, "кокос"],
                [9, "банан"],
                [10, "помело"],
                [11, "клубника"],
                [12, "малина"],
                [13, "дыня"],
                [14, "абрикос"],
                [15, "манго"],
                [16, "слива"],
                [17, "гранат"],
                [18, "вишня"],
            ]
        );

        $this->batchInsert(
            "word_eng",
            ["id", "word"],
            [
                [1, "apple"],
                [2, "pear"],
                [3, "orange"],
                [4, "grape"],
                [5, "lemon"],
                [6, "pineapple"],
                [7, "watermelon"],
                [8, "coconut"],
                [9, "banana"],
                [10, "pomelo"],
                [11, "strawberry"],
                [12, "raspberry"],
                [13, "mellon"],
                [14, "apricot"],
                [15, "mango"],
                [16, "pear"],
                [17, "pomegranate"],
                [18, "cherry"],
            ]
        );

        $this->batchInsert(
            "relation",
            ["ru", "eng"],
            [
                [1, 1],
                [2, 2],
                [3, 3],
                [4, 4],
                [5, 5],
                [6, 6],
                [7, 7],
                [8, 8],
                [9, 9],
                [10, 10],
                [11, 11],
                [12, 12],
                [13, 13],
                [14, 14],
                [15, 15],
                [16, 16],
                [17, 17],
                [18, 18],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->delete("relation");
        $this->delete("word_ru");
        $this->delete("word_eng");
    }
}
