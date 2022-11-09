<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%role}}`.
 */
class m221109_191113_add_isDeleted_column_to_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%role}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%role}}', 'isDeleted');
    }
}
