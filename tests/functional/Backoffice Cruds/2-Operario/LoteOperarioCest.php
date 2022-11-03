<?php
require_once( __DIR__ . "/../1-Cliente/LoteClienteCest.php");
class LoteOperarioCest extends LoteClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['lote/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Lote', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Lote");
        $I->fillField(["name"=>"Lote[codigo_lote]"], "GRN_VRM_00005");
        $I->fillField(["name"=>"Lote[idProduto]"], "2");
        $I->fillField(["name"=>"Lote[quantidade]"], "15");
        $I->selectOption('Lote[idLocalExtracao]', array('value' => 3));
        $I->fillField(["name"=>"Lote[idLocalArmazem]"], "2");
        $I->fillField(["name"=>"Lote[dataHora]"], "2022-01-01 23:23:23");
        $I->click("Save");
        $I->See("GRN_VRM_00005");
        $I->See("2");
        $I->See("15");
        $I->See("3");
        $I->See("2022-01-01 23:23:23");
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['lote/view?codigo_lote=GRN_LRJ_00001']);
        $I->See("GRN_LRJ_00001");
        $I->See("1");
        $I->See("475");
        $I->See("3");
        $I->See("1");
        $I->See("2022-04-22 23:19:01");
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['lote/update?codigo_lote=GRN_LRJ_00001']);
        $I->see('Update Lote');
        $I->fillField(["name"=>"Lote[idProduto]"], "2");
        $I->fillField(["name"=>"Lote[quantidade]"], "150");
        $I->selectOption('Lote[idLocalExtracao]', array('value' => 3));
        $I->fillField(["name"=>"Lote[idLocalArmazem]"], "2");
        $I->fillField(["name"=>"Lote[dataHora]"], "2022-01-01 23:25:23");
        $I->click("Save");
        $I->See("2");
        $I->See("150");
        $I->See("3");
        $I->See("2022-01-01 23:25:23");
    }
}