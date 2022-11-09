<?php

use yii\db\Migration;

/**
 * Class m221109_191730_insert_value_to_codigoDesconto_table
 */
class m221109_191730_insert_value_to_codigoDesconto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('codigoDesconto', [
            'codigo' => 'DSC_001',
            'descricao' => 'Primeiro Desconto.',
            'idProduto' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('codigoDesconto', ['id' => 1]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221109_191730_insert_value_to_codigoDesconto_table cannot be reverted.\n";

        return false;
    }
    */
}
