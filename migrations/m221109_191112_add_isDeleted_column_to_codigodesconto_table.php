<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%codigodesconto}}`.
 */
class m221109_191112_add_isDeleted_column_to_codigodesconto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%codigodesconto}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%codigodesconto}}', 'isDeleted');
    }
}
