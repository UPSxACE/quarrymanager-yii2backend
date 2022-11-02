<?php
require_once( __DIR__ . "/../1-Cliente/FotografiaLoteClienteCest.php");
class FotografiaLoteOperarioCest extends FotografiaLoteClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['fotografia-lote/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Fotografia Lotes', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Fotografia Lote");
        $I->fillField(["name"=>"FotografiaLote[codigoLote]"], "GRN_LRJ_00001");
        $I->fillField(["name"=>"FotografiaLote[idFotografia]"], "1");
        $I->click("Save");
        $I->See("GRN_LRJ_00001");
        $I->See("1");
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['fotografia-lote/view?id=1']);
        $I->See("GRN_LRJ_00001");
        $I->See("9");
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['fotografia-lote/update?id=1']);
        $I->see('Update Fotografia Lote');
        $I->fillField(["name"=>"FotografiaLote[codigoLote]"], "GRN_LRJ_00002");
        $I->fillField(["name"=>"FotografiaLote[idFotografia]"], "2");
        $I->click("Save");
        $I->See("GRN_LRJ_00002");
        $I->See("2");
    }
}