<?php
require_once( __DIR__ . "/../Cliente/DashboardClienteCest.php");
class DashboardOperarioCest extends DashboardClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
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
        $I->dontSee('Transportadoras','li');
        $I->dontSee('Loja','.col-2 li');
        $I->dontSee('Clientes','li');
        $I->dontSee('Operários','li');
        $I->dontSee('Gestores','li');
        $I->dontSee('Administradores','li');
        $I->dontSee('Locais de Armazéns','li');
        $I->dontSee('Locais de Extração','li');
        $I->dontSee('Logs','li');
    }
}
