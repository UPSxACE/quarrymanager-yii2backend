<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%fotografia_lote}}`.
 */
class m221109_191112_add_isDeleted_column_to_fotografia_lote_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%fotografia_lote}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%fotografia_lote}}', 'isDeleted');
    }
}
