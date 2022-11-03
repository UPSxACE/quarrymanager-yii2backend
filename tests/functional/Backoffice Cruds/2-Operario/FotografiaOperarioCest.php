<?php
require_once( __DIR__ . "/../1-Cliente/FotografiaClienteCest.php");
class FotografiaOperarioCest extends FotografiaClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['fotografia/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Fotografias', 'h1');
    }

    public function createTest(\FunctionalTester $I)
    {
        $I->click("Create Fotografia");
        $I->fillField(["name" => "Fotografia[link]"], "fotos/bisdibf.png");
        $I->click("Save");
        $I->see("fotos/bisdibf.png");
    }


    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['fotografia/view?id=1']);
        $I->See("profilePictures/genericUserProfilePicture.svg");
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['fotografia/update?id=1']);
        $I->see('Update Fotografia: 1');
        $I->fillField(["name" => "Fotografia[link]"], "fotos/fotomaria.png");
        $I->click("Save");
        $I->see("fotos/fotomaria.png");

    }
}