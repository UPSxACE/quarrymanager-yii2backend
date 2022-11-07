<?php

class UserAdminCest{
    public function _before(\FunctionalTester $I){
        $I->amLoggedInAs(1);
        $I->amOnPage(['user/admin']);
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['user/admin/view?id=1']);
    }
}