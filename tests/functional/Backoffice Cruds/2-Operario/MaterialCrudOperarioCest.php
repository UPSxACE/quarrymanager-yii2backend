<?php
require_once(__DIR__ . "/../1-Cliente/MaterialCrudClienteCest.php");
class MaterialCrudOperarioCest extends MaterialCrudClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['material/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Materials', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Material");
        $I->fillField(["name"=>"Material[nome]"], "GRa");
        $I->click("Save");
        $I->See("GRa");
    }

    public function updateTest(\FunctionalTester $I){
        $I->amOnPage(['/material/update?id=1']);
        $I->See("Update Material");
        $I->fillField(["name"=>"Material[nome]"], "Areia");
        $I->click("Save");
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['material/view?id=1']);
        $I->See("Granito");
    }
}