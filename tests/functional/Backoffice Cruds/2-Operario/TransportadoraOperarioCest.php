<?php
require_once( __DIR__ . "/../1-Cliente/TransportadoraClienteCest.php");
class TransportadoraOperarioCest extends TransportadoraClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['transportadora/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Transportadoras', 'h1');
    }

    public function viewTest(\FunctionalTester $I)
    {
        $I->amOnPage(['transportadora/view?id=1']);
        $I->see('Unipessoal');
    }

    public function createTest(\FunctionalTester $I)
    {
        $I->click('Create Transportadora');
        $I->fillField(["name"=>'Transportadora[nome]'],"UPS");
        $I->click('Save', 'button');
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['transportadora/update?id=1']);
        $I->see('Update Transportadora');
        $I->fillField(["name"=>'Transportadora[nome]'],"Correios");
        $I->click('Save', 'button');
    }


    public function deleteTest(\FunctionalTester $I){
        $I->amOnPage(['transportadora/delete?id=1']);
        $I->See("Transportadoras");
    }

    public function findModelFailTest(\FunctionalTester $I){
        $I->amOnPage(['transportadora/view?id=-1']);
        $I->canSeeResponseCodeIs(404);
    }
}