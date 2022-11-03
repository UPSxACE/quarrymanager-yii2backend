<?php
class PedidoLoteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['pedido-lote/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}