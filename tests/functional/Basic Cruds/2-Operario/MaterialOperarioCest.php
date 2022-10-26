<?php
// require_once( __DIR__ . "/../1-Cliente/ProdutosClienteCest.php");
class MaterialOperarioCest // extends ProdutosClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/materiais']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Materiais', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click('Novo Material');
        $I->fillField(["name"=>"Material[nome]"], "Rochedo");
        $I->fillField(["name"=>"Material[prefixo]"], "RCD");
        $I->click('Save');
        $I->seeRecord('app\models\Material', ["nome" => "Rochedo", "prefixo" => "RCD"]);
    }
}
