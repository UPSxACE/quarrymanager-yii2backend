<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%fotografia_produto}}`.
 */
class m221109_191112_add_isDeleted_column_to_fotografia_produto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%fotografia_produto}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%fotografia_produto}}', 'isDeleted');
    }
}
