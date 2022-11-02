<?php
class PedidoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['pedido/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}
