<?php
class CodigoDescontoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['codigo-desconto/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}
