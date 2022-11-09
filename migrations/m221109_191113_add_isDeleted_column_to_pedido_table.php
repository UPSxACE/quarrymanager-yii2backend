<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pedido}}`.
 */
class m221109_191113_add_isDeleted_column_to_pedido_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pedido}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pedido}}', 'isDeleted');
    }
}
