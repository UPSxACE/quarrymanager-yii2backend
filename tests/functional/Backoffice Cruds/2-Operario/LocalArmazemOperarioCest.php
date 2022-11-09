<?php
require_once( __DIR__ . "/../1-Cliente/LocalArmazemClienteCest.php");
class LocalArmazemOperarioCest extends LocalArmazemClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['local-armazem/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Local Armazems', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Local Armazem");
        $I->fillField(["name"=>"LocalArmazem[nome]"], "Armazem do Bairro");
        $I->click("Save");
        $I->See("Armazem do Bairro");
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['local-armazem/view?id=1']);
        $I->See("Areeiro da Serra");
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['local-armazem/update?id=1']);
        $I->see('Update Local Armazem: 1');
        $I->fillField(["name"=>"LocalArmazem[nome]"], "Armazem de Rua");
        $I->click("Save");
        $I->See("Armazem de Rua");
    }

    public function deleteTest(\FunctionalTester $I){
        $I->amOnPage(['local-armazem/delete?id=1']);
        $I->See("Local Armazems");
    }

    public function findModelFailTest(\FunctionalTester $I){
        $I->amOnPage(['local-armazem/view?id=-1']);
        $I->canSeeResponseCodeIs(404);
    }
}