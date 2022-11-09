<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%logs}}`.
 */
class m221109_191113_add_isDeleted_column_to_logs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%logs}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%logs}}', 'isDeleted');
    }
}
