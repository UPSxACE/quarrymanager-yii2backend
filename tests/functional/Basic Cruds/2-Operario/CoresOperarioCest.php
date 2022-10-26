<?php
// require_once( __DIR__ . "/../1-Cliente/ProdutosClienteCest.php");
class CoresOperarioCest // extends ProdutosClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/cores']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Cores', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click('Nova Cor');
        $I->fillField(["name"=>"Cor[nome]"], "Cristal");
        $I->fillField(["name"=>"Cor[prefixo]"], "CRS");
        $I->click('Save');
        $I->seeRecord('app\models\Cor', ["nome" => "Cristal", "prefixo" => "CRS"]);
    }
}
