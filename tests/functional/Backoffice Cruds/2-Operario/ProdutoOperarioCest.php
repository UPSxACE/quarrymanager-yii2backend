<?php
require_once( __DIR__ . "/../1-Cliente/ProdutoClienteCest.php");
class ProdutoOperarioCest extends ProdutoClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['produto/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Produtos', 'h1');
    }

    public function viewTest(\FunctionalTester $I)
    {
        $I->amOnPage(['produto/view?id=1']);
        $I->see('1');
        $I->see('2');
        $I->see('3');
        $I->see('5');
        $I->see('6');
        $I->see('Granito Laranja');
        $I->see('Fino e sofisticado!');
    }

    public function createTest(\FunctionalTester $I)
    {
        $I->click('Create Produto');
        $I->fillField(["name"=>'Produto[idMaterial]'],1);
        $I->fillField(["name"=>'Produto[idCor]'],1);
        $I->fillField(["name"=>'Produto[Res_Compressao]'],5.10);
        $I->fillField(["name"=>'Produto[Res_Flexao]'],6.70);
        $I->fillField(["name"=>'Produto[Massa_Vol_Aparente]'],3.4);
        $I->fillField(["name"=>'Produto[Absorcao_Agua]'],69.69);
        $I->fillField(["name"=>'Produto[tituloArtigo]'],"Areia");
        $I->fillField(["name"=>'Produto[descricaoProduto]'],"Areia Sedimentar");
        $I->fillField(["name"=>'Produto[preco]'],20.69);
        $I->click('Save', 'button');
    }
}