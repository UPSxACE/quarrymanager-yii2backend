<?php
class LocalExtracaoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['local-extracao/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}