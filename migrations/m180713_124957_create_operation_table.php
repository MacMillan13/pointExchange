<?php

use yii\db\Migration;

/**
 * Handles the creation of table `operation`.
 */
class m180713_124957_create_operation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('operation', [
            'id' => $this->primaryKey(),
            'sentFrom' => $this->string(),
            'howMuch' => $this->float(),
            'sentTo' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('operation');
    }
}
