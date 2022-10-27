<?php

class LojaCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['loja/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Loja', 'h1');
    }
        
    public function comprarTest(\FunctionalTester $I)
    {
        $I->amOnPage(['loja/produto/4']);
        $I->see('Para efetuar um pedido');
    }


}