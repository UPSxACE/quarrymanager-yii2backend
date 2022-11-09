<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%localextracao}}`.
 */
class m221109_191113_add_isDeleted_column_to_localextracao_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%localextracao}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%localextracao}}', 'isDeleted');
    }
}
