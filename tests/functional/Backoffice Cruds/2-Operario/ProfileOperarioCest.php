<?php
require_once( __DIR__ . "/../1-Cliente/ProfileClienteCest.php");
class ProfileOperarioCest extends ProfileClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['profile/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Profiles', 'h1');
    }

    public function createTest(\FunctionalTester $I)
    {
        $I->click("Create Profile");
        $I->fillField(["name" => "Profile[user_id]"], "1");
        $I->fillField(["name" => "Profile[idFotografia]"], "6");
        $I->fillField(["name" => "Profile[email]"], "jorge@gmail.com");
        $I->fillField(["name" => "Profile[full_name]"], "Jose Manuel");
        $I->fillField(["name" => "Profile[telefone]"], "912345678");
        $I->fillField(["name" => "Profile[morada]"], "Rua Bairro Alto");
        $I->fillField(["name" => "Profile[localidade]"], "Minho");
        $I->fillField(["name" => "Profile[codPostal]"], "5300-000");
        $I->fillField(["name" => "Profile[nif]"], "1234567890");
        $I->fillField(["name" => "Profile[nib]"], "ni123456789");
        $I->fillField(["name" => "Profile[created_at]"], "2022-04-22 21:48:25");
        $I->fillField(["name" => "Profile[updated_at]"], "2022-04-22 21:48:38");
        $I->fillField(["name" => "Profile[timezone]"], "qwer1234");
        $I->click("Save");
        $I->See("1");
        $I->See("6");
        $I->See("jorge@gmail.com");
        $I->See("Jose Manuel");
        $I->See("912345678");
        $I->See("Rua Bairro Alto");
        $I->See("Minho");
        $I->See("5300-000");
        $I->See("1234567890");
        $I->See("ni123456789");
        $I->See("2022-04-22 21:48:25");
        $I->See("2022-04-22 21:48:38");
        $I->See("qwer1234");

    }

    public function viewTest(\FunctionalTester $I)
    {
        $I->amOnPage(['profile/view?id=1']);
        $I->See("1");
        $I->See("1");
        $I->See("4");
        $I->See("admin@gmail.com");
        $I->See("Miguel Rocha");
        $I->See("962075694");
        $I->See("Rua de Bragança");
        $I->See("Bragança");
        $I->See("5300-116");
        $I->See("2022-03-31 02:38:51");
        $I->See("2022-03-31 02:38:51");

    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['profile/update?id=1']);
        $I->see('Update Profile');
        $I->fillField(["name" => "Profile[user_id]"], "5");
        $I->fillField(["name" => "Profile[idFotografia]"], "4");
        $I->fillField(["name" => "Profile[email]"], "manel@gmail.com");
        $I->fillField(["name" => "Profile[full_name]"], "Joaquim");
        $I->fillField(["name" => "Profile[telefone]"], "987456321");
        $I->fillField(["name" => "Profile[morada]"], "Rua Bairro Baixo");
        $I->fillField(["name" => "Profile[localidade]"], "Algarve");
        $I->fillField(["name" => "Profile[codPostal]"], "7200-230");
        $I->fillField(["name" => "Profile[nif]"], "987654321");
        $I->fillField(["name" => "Profile[nib]"], "987321456ni");
        $I->fillField(["name" => "Profile[created_at]"], "2021-10-10 21:48:25");
        $I->fillField(["name" => "Profile[updated_at]"], "2021-01-22 21:48:38");
        $I->fillField(["name" => "Profile[timezone]"], "zxcv9876");
        $I->click("Save");
        $I->See("5");
        $I->See("4");
        $I->See("manel@gmail.com");
        $I->See("Joaquim");
        $I->See("987654321");
        $I->See("Rua Bairro Baixo");
        $I->See("Algarve");
        $I->See("7200-230");
        $I->See("987654321");
        $I->See("987321456ni");
        $I->See("2021-10-10 21:48:25");
        $I->See("2021-01-22 21:48:38");
        $I->See("zxcv9876");
    }
}