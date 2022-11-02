<?php
require_once( __DIR__ . "/../1-Cliente/CodigoDescontoClienteCest.php");
class CodigoDescontoOperarioCest extends CodigoDescontoClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['codigo-desconto/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Codigo Descontos', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Codigo Desconto");
        $I->fillField(["name"=>"CodigoDesconto[codigo]"], "zzz123");
        $I->fillField(["name"=>"CodigoDesconto[descricao]"], "zzz123");
        $I->click("Save");
        $I->See("zzz123");
    }

}