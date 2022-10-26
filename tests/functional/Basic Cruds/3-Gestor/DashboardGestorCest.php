<?php
require_once( __DIR__ . "/../2-Operario/DashboardOperarioCest.php");
class DashboardGestorCest extends DashboardOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Home', 'h1');
        $I->see('Home', 'li');
        $I->see('Lotes', 'li');
        $I->see('Stock', 'li');
        $I->see('Produtos', 'li');
        $I->see('Materiais', 'li');
        $I->see('Cores', 'li');
        $I->see('Encomendas', 'li');
        $I->see('Transportadoras','li');
        $I->see('Loja','.col-2 li');
        $I->see('Clientes','li');
        $I->see('Operários','li');
        $I->dontSee('Gestores','li');
        $I->dontSee('Administradores','li');
        $I->dontSee('Locais de Armazéns','li');
        $I->dontSee('Locais de Extração','li');
        $I->see('Logs','li');
    }
}
