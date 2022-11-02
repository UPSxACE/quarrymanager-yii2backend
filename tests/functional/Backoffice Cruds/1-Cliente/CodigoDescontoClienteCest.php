<?php
require_once( __DIR__ . "/../CodigoDescontoCest.php");
class CodigoDescontoClienteCest extends CodigoDescontoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['codigo-desconto/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}