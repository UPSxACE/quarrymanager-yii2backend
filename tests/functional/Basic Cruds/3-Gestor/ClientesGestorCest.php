<?php

class ClientesGestorCest{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/clientes']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Clientes', 'h1');
    }

}