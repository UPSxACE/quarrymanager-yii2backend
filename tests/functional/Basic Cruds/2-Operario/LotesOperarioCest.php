<?php

class LotesOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/lotes']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Lotes', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click('Novo Lote');
        $I->selectOption('UploadFormLote[idProduto]', array('value' => '1'));
        $I->selectOption('UploadFormLote[idLocalArmazem]', array('value' => '2'));
        $I->selectOption('UploadFormLote[idLocalExtracao]', array('value' => '2'));
        $I->fillField(["name"=>"UploadFormLote[quantidade]"], "1000.25");
        $I->attachFile('[name="UploadFormLote[imageFiles][]"][type="file"]', 'test-pic.png');
        $I->click('Save');
        $I->seeRecord('app\models\Lote', ['and',['idProduto' => "1", 'idLocalArmazem' => "2", "idLocalExtracao" => "2"],"quantidade LIKE 1000.25"]);
    }

    public function loteActionTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/lotes/GRN_LRJ_00001']);
        $I->see("GRN_LRJ_00001");
        $I->see("Granito");
        $I->see("Laranja");
        $I->see("Moca");
        $I->see("Areeiro da Serra");
    }

    public function loteUpdate(\FunctionalTester $I){
        $I->amOnPage(['dashboard/lotes/GRN_LRJ_00001']);
        $I->see("GRN_LRJ_00001");
        $I->see("Granito");
        $I->see("Laranja");
        $I->click("Update");
        $I->selectOption('Lote[idProduto]', array('text' => 'Granito Vermelho'));
        $I->fillField(["name"=>"Lote[quantidade]"], "700");
        $I->click("Save");
        $I->see("GRN_LRJ_00001");
        $I->see("Granito");
        $I->see("Vermelho");
        $I->see("700m²");
    }

    public function loteDelete(\FunctionalTester $I){
        $I->amOnPage(['dashboard/delete-lote?codigo_lote=GRN_LRJ_00001']);
        $I->canSeeResponseCodeIsSuccessful();

    }

}
