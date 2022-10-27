<?php

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

require_once( __DIR__ . "/../PerfilDefinicoesCest.php");
class PerfilDefinicoesOperarioCest extends PerfilDefinicoesCest
{

    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['perfil/definicoes']);
    }
    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Definições da Conta', 'h1');
    }
    public function updatePerfilConfigTest(\FunctionalTester $I)
    {
        $I->fillField(["name"=>'User[username]'],"Operario");
        $I->fillField(["name"=>'User[currentPassword]'],"operario");
        $I->fillField(["name"=>'User[newPassword]'],"operario123");
        $I->fillField(["name"=>'User[newPasswordConfirm]'],"operario123");
        $I->click('Save', 'button');
        $I->see('Definições da conta atualizados com sucesso.');
    }
}