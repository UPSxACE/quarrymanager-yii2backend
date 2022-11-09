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

    public function updateTest(\FunctionalTester $I){
        $I->amOnPage(['codigo-desconto/update?codigo=1']);
        $I->See("Update");
        $I->fillField(["name"=>"CodigoDesconto[descricao]"], "Segundo Desconto.");
        $I->click("Save");
    }

    public function deleteTest(\FunctionalTester $I){
        $I->amOnPage(['codigo-desconto/delete?codigo=1']);
        $I->See("Codigo Descontos");
    }

    public function findModelFailTest(\FunctionalTester $I){
        $I->amOnPage(['codigo-desconto/view?codigo=-1']);
        $I->canSeeResponseCodeIs(404);
    }
}