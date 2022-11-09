<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%profile}}`.
 */
class m221109_191113_add_isDeleted_column_to_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%profile}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%profile}}', 'isDeleted');
    }
}
