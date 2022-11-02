<?php
class FotografiaProdutoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['fotografia-lote/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}
