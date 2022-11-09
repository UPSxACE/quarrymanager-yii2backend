<?php
require_once( __DIR__ . "/../1-Cliente/CorClienteCest.php");
class CorOperarioCest extends CorClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['cor/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Cors', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Cor");
        $I->fillField(["name"=>"Cor[nome]"], "Preto");
        $I->click("Save");
        $I->See("Preto");
    }

    public function updateTest(\FunctionalTester $I){
        $I->amOnPage(['cor/update?id=1']);
        $I->See("Update Cor");
        $I->fillField(["name"=>"Cor[nome]"], "Branco");
        $I->click("Save");
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['cor/view?id=1']);
        $I->See("Laranja");
    }

    public function deleteTest(\FunctionalTester $I){
        $I->amOnPage(['cor/delete?id=1']);
        $I->See("Cors");
    }

    public function findModelFailTest(\FunctionalTester $I){
        $I->amOnPage(['cor/view?id=-1']);
        $I->canSeeResponseCodeIs(404);
    }
}