<?php
require_once( __DIR__ . "/../1-Cliente/ProdutosClienteCest.php");
class ProdutosOperarioCest extends ProdutosClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/produtos']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Produtos', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        // id de 'Mármore' na tabela Material da BD
        $marmoreId = 3;
        // id de 'Branco' na tabela Cor da BD
        $corId = 3;

        $I->click('Novo Produto');
        $I->selectOption('Produto[idMaterial]', array('text' => 'Marmore'));
        $I->selectOption('Produto[idCor]', array('text' => 'Branco'));
        $I->fillField(["name"=>"Produto[Res_Compressao]"], 5.23);
        $I->fillField(["name"=>"Produto[Res_Flexao]"], 7.75);
        $I->fillField(["name"=>"Produto[Massa_Vol_Aparente]"], 2);
        $I->fillField(["name"=>"Produto[Absorcao_Agua]"], 3.21);
        $I->click('Save');
        $I->seeRecord('app\models\Produto', ['idMaterial' => $marmoreId, 'idCor' => $corId, 'Massa_Vol_Aparente' => 2, 'Res_Flexao' => 7.75]);
    }
}
