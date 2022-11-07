<?php

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

require_once( __DIR__ . "/../PerfilCest.php");
class PerfilClienteCest extends PerfilCest
{

    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['perfil/meu-perfil']);
    }
    public function indexTest(\FunctionalTester $I)
    {
        $I->amOnPage(['perfil/']);
        $I->see('Meu Perfil', 'h1');
    }
    public function meuPerfilTest(\FunctionalTester $I)
    {
        $I->see('Meu Perfil', 'h1');
    }
    public function updatePerfilTest(\FunctionalTester $I)
    {
        $I->fillField(["name"=>'Profile[full_name]'],"Rui");
        $I->fillField(["name"=>'Profile[dataNascimento]'],"2000-04-10");
        $I->selectOption('Profile[genero]', array('text' => 'Feminino'));
        $I->fillField(["name"=>'Profile[morada]'],"Rua do Aleixo");
        $I->fillField(["name"=>'Profile[codPostal]'],"1000-000");
        $I->fillField(["name"=>'Profile[localidade]'],"Lisboa");

        $I->click('Save', 'button');
        $I->see('Dados da conta atualizados com sucesso.');
    }

    public function updateProfilePicture(\FunctionalTester $I){
        $I->attachFile('[name="UploadForm[imageFile]"][type="file"]', 'test-pic.png');
        $I->click("Submit", "form button");
        $I->see("Fotografia de perfil atualizada com sucesso.");
    }

}