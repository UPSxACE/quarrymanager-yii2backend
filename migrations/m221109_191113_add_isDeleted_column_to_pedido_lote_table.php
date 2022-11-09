<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pedido_lote}}`.
 */
class m221109_191113_add_isDeleted_column_to_pedido_lote_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pedido_lote}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pedido_lote}}', 'isDeleted');
    }
}
