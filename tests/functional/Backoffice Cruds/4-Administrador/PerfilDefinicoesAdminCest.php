<?php

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

require_once( __DIR__ . "/../PerfilDefinicoesCest.php");
class PerfilDefinicoesAdminCest extends PerfilDefinicoesCest
{

    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['perfil/definicoes']);
    }
    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Definições da Conta', 'h1');
    }
    public function updatePerfilConfigTest(\FunctionalTester $I)
    {
        $I->fillField(["name"=>'User[username]'],"Administrador");
        $I->fillField(["name"=>'User[currentPassword]'],"admin");
        $I->fillField(["name"=>'User[newPassword]'],"admin123");
        $I->fillField(["name"=>'User[newPasswordConfirm]'],"admin123");
        $I->click('Save', 'button');
        $I->see('Definições da conta atualizados com sucesso.');
    }
}