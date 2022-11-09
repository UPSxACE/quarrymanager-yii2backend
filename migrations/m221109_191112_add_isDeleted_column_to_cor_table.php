<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cor}}`.
 */
class m221109_191112_add_isDeleted_column_to_cor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cor}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cor}}', 'isDeleted');
    }
}
