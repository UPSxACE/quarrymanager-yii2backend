<?php
require_once( __DIR__ . "/../1-Cliente/EncomendaClienteCest.php");
class EncomendaOperarioCest extends EncomendaClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/encomendas']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Encomendas', 'h1');
    }

    public function actionInterfaceTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1']);
        $I->see("Encomenda #000001", "h1");
        $I->see("João");
        $I->see("Rua do Porto");
        $I->see("cliente@gmail.com");
        $I->see("Pedra Branca");
        $I->see("Pedido realizado em: 2022-04-22 23:17:13");
    }

    public function statusTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1']);
        $I->see("Recebido");
        $I->click("(forçar mudança de estado)");
        $I->see("Forbidden (#403)");
    }

    public function cancelTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1']);
        $I->see("Recebido");
        $I->click("Cancelar Encomenda");
        $I->see("Forbidden (#403)");
    }
}
