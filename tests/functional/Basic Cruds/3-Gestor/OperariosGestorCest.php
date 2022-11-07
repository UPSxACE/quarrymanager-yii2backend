<?php

class OperariosGestorCest{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/operarios']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Operários', 'h1');
    }

}