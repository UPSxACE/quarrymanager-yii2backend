<?php
require_once( __DIR__ . "/../1-Cliente/EstadoClienteCest.php");
class EstadoOperarioCest extends EstadoClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['estado/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Estados', 'h1');
    }

    public function createTest(\FunctionalTester $I)
    {
        $I->see('Estados');
        $I->see('Create Estado', 'a');
        $I->click("Create Estado");
        $I->fillField(["name"=>'Estado[nome]'],"estado1");
        $I->see('Save', 'button');
        $I->click("Save");
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['estado/update?id=1']);
        $I->see('Update Estado');
        $I->fillField(["name"=>'Estado[nome]'],"estado1");
        $I->see('Save', 'button');
        $I->click("Save");
        $I->see('estado1');

    }

    public function deleteTest(\FunctionalTester $I){
        $I->amOnPage(['estado/delete?id=1']);
        $I->See("Estados");
    }

    public function findModelFailTest(\FunctionalTester $I){
        $I->amOnPage(['estado/view?id=-1']);
        $I->canSeeResponseCodeIs(404);
    }
}