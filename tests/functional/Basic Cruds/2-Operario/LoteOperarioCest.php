<?php

class LoteOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['dashboard/lotes']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Lotes', 'h1');
    }
}
