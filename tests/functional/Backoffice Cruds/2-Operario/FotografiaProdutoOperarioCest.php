<?php
require_once( __DIR__ . "/../1-Cliente/FotografiaProdutoClienteCest.php");
class FotografiaProdutoOperarioCest extends FotografiaProdutoClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['fotografia-produto/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Fotografia Produtos', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Fotografia Produto");
        $I->fillField(["name"=>"FotografiaProduto[idProduto]"], "2");
        $I->fillField(["name"=>"FotografiaProduto[idFotografia]"], "1");
        $I->click("Save");
        $I->See("1");
        $I->See("2");
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['fotografia-produto/view?id=1']);
        $I->See("2");
        $I->See("5");
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['fotografia-produto/update?id=1']);
        $I->see('Update Fotografia Produto');
        $I->fillField(["name"=>"FotografiaProduto[idProduto]"], "3");
        $I->fillField(["name"=>"FotografiaProduto[idFotografia]"], "2");
        $I->click("Save");
        $I->See("3");
        $I->See("2");
    }
}