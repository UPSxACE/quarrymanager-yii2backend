<?php
require_once( __DIR__ . "/../1-Cliente/TipoAcaoClienteCest.php");
class TipoAcaoOperarioCest extends TipoAcaoClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['tipo-acao/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Tipo Acaos', 'h1');
    }

    public function viewTest(\FunctionalTester $I)
    {
        $I->amOnPage(['tipo-acao']);
        $I->see('1');
        $I->see('2');
        $I->see('3');
        $I->see('Administração');
        $I->see('Stock');
        $I->see('Loja');
    }

    public function createTest(\FunctionalTester $I)
    {
        $I->click('Create Tipo Acao');
        $I->fillField(["name"=>'TipoAcao[nome]'],"Teste");
        $I->click('Save', 'button');
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['tipo-acao/update?id=1']);
        $I->see('Update Tipo Acao');
        $I->fillField(["name"=>'TipoAcao[nome]'],"Teste1");
        $I->click('Save', 'button');
    }


    public function deleteTest(\FunctionalTester $I){
        $I->amOnPage(['tipo-acao/delete?id=1']);
        $I->See("Tipo Acaos");
    }

    public function findModelFailTest(\FunctionalTester $I){
        $I->amOnPage(['tipo-acao/view?id=-1']);
        $I->canSeeResponseCodeIs(404);
    }
}