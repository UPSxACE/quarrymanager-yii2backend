<?php

class AdministradoresAdminCest{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['dashboard/administradores']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Administradores', 'h1');
    }

}