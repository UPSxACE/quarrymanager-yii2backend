<?php

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

require_once( __DIR__ . "/../PerfilDefinicoesCest.php");
class PerfilDefinicoesClienteCest extends PerfilDefinicoesCest
{

    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['perfil/definicoes']);
    }
    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Definições da Conta', 'h1');
    }
    public function updatePerfilConfigTest(\FunctionalTester $I)
    {
        $I->fillField(["name"=>'User[username]'],"Clientinho");
        $I->fillField(["name"=>'User[currentPassword]'],"cliente");
        $I->fillField(["name"=>'User[newPassword]'],"cliente123");
        $I->fillField(["name"=>'User[newPasswordConfirm]'],"cliente123");
        $I->click('Save', 'button');
        $I->see('Definições da conta atualizados com sucesso.');
    }
    public function updatePerfilEmailTest(\FunctionalTester $I)
    {
        $I->fillField(["name"=>'User[username]'],"cliente");
        $I->fillField(["name"=>'User[currentPassword]'],"cliente");
        $I->fillField(["name"=>'User[email]'],"gestor2@gmail.com");
        $I->click('Save', 'button');
        $I->see('Definições da conta atualizados com sucesso.');
    }
    public function updatePerfilConfigFailPasswordTest(\FunctionalTester $I)
    {
        $I->fillField(["name"=>'User[username]'],"Clientinho");
        $I->fillField(["name"=>'User[currentPassword]'],"cliente");
        $I->fillField(["name"=>'User[newPassword]'],"cliente123");
        $I->fillField(["name"=>'User[newPasswordConfirm]'],"cliente1234");
        $I->click('Save', 'button');
        $I->see('Passwords do not match');
    }
    public function updatePerfilConfigFailPasswordConfirmTest(\FunctionalTester $I)
    {
        $I->fillField(["name"=>'User[username]'],"Clientinho");
        $I->fillField(["name"=>'User[currentPassword]'],"cliente123");
        $I->click('Save', 'button');
        $I->see('Account not updated. Incorrect password.');
    }
}