<?php

class EstadoPedidoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['estado-pedido/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}