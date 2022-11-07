<?php

class GestoresAdminCest{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['dashboard/gestores']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Gestores', 'h1');
    }

}