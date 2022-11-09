<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%estado_pedido}}`.
 */
class m221109_191112_add_isDeleted_column_to_estado_pedido_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%estado_pedido}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%estado_pedido}}', 'isDeleted');
    }
}
