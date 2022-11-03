<?php
class EncomendaCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['dashboard/encomendas']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }
}
