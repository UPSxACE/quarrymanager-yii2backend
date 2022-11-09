<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%lote}}`.
 */
class m221109_191113_add_isDeleted_column_to_lote_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lote}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%lote}}', 'isDeleted');
    }
}
