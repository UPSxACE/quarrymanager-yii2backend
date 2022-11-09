<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%transportadora}}`.
 */
class m221109_191114_add_isDeleted_column_to_transportadora_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%transportadora}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%transportadora}}', 'isDeleted');
    }
}
