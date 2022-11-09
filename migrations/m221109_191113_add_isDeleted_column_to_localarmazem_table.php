<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%localarmazem}}`.
 */
class m221109_191113_add_isDeleted_column_to_localarmazem_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%localarmazem}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%localarmazem}}', 'isDeleted');
    }
}
