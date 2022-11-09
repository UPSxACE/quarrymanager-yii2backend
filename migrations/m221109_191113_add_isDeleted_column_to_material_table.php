<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%material}}`.
 */
class m221109_191113_add_isDeleted_column_to_material_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%material}}', 'isDeleted', $this->smallInteger(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%material}}', 'isDeleted');
    }
}
