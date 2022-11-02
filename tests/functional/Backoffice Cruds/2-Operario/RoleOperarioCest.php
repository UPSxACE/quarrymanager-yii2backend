<?php
require_once( __DIR__ . "/../1-Cliente/RoleClienteCest.php");
class RoleOperarioCest extends RoleClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['role/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Roles', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Role");
        $I->fillField(["name"=>"Role[name]"], "Joaquim");
        $I->fillField(["name"=>"Role[can_admin]"], "1");
        $I->fillField(["name"=>"Role[can_gestor]"], "0");
        $I->fillField(["name"=>"Role[can_operario]"], "1");
        $I->click("Save");
        $I->see("Joaquim");
    }


    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['cor/view?id=1']);
        $I->See("Laranja");
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['role/update?id=1']);
        $I->see('Update');
        $I->fillField(["name"=>"Role[name]"], "Joaquim");
        $I->fillField(["name"=>"Role[can_admin]"], "0");
        $I->fillField(["name"=>"Role[can_gestor]"], "1");
        $I->fillField(["name"=>"Role[can_operario]"], "0");
        $I->click("Save");
        $I->See("Joaquim");
        $I->See("0");
        $I->See("1");
        $I->See("0");
    }
}
