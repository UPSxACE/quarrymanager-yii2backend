<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%estado}}`.
 */
class m221109_191112_add_isDeleted_column_to_estado_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%estado}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%estado}}', 'isDeleted');
    }
}
