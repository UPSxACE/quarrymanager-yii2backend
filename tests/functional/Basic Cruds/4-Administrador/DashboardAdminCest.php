<?php
require_once( __DIR__ . "/../Gestor/DashboardGestorCest.php");
class DashboardAdminCest extends DashboardGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['dashboard/home']);
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
        $I->see('Gestores','li');
        $I->see('Administradores','li');
        $I->see('Locais de Armazéns','li');
        $I->see('Locais de Extração','li');
        $I->see('Logs','li');
    }
}
