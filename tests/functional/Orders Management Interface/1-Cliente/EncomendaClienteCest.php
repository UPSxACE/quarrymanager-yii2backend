<?php
require_once( __DIR__ . "/../EncomendaCest.php");
class EncomendaClienteCest extends EncomendaCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['dashboard/encomendas']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}
