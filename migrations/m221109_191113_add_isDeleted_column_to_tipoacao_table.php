<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%tipoacao}}`.
 */
class m221109_191113_add_isDeleted_column_to_tipoacao_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tipoacao}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%tipoacao}}', 'isDeleted');
    }
}
