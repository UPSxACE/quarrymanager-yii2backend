<?php
require_once( __DIR__ . "/../1-Cliente/LocalExtracaoClienteCest.php");
class LocalExtracaoOperarioCest extends LocalExtracaoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['local-extracao/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Local Extracaos', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Local Extracao");
        $I->fillField(["name"=>"LocalExtracao[nome]"], "Vila");
        $I->fillField(["name"=>"LocalExtracao[coordenadasGPS_X]"], "3.2486");
        $I->fillField(["name"=>"LocalExtracao[coordenadasGPS_Y]"], "1.8954");
        $I->click("Save");
        $I->See("Vila");
        $I->See("3.2486");
        $I->See("1.8954");
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['local-extracao/view?id=1']);
        $I->See("Moleanos");
        $I->See("153");
        $I->See("200");

    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['local-extracao/update?id=1']);
        $I->see('Update Local Extracao');
        $I->fillField(["name"=>"LocalExtracao[nome]"], "Cidade");
        $I->fillField(["name"=>"LocalExtracao[coordenadasGPS_X]"], "2.465");
        $I->fillField(["name"=>"LocalExtracao[coordenadasGPS_Y]"], "4.486");
        $I->click("Save");
        $I->See("Cidade");
        $I->See("2.465");
        $I->See("4.486");
    }
}