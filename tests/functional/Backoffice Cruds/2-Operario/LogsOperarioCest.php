<?php
require_once( __DIR__ . "/../1-Cliente/LogsClienteCest.php");
class LogsOperarioCest extends LogsClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['logs/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Logs', 'h1');
    }


    public function createTest(\FunctionalTester $I)
    {
        $I->click('Create Logs');
        $I->see("Create Logs");
        $I->fillField(["name"=>'Logs[idUser]'],1);
        $I->fillField(["name"=>'Logs[idTipoAcao]'],2);
        $I->fillField(["name"=>'Logs[descricao]'],"O local de armazém 'Areeiro de Bragança' foi criado.");
        $I->fillField(["name"=>'Logs[dataHora]'],"2022-11-02 14:29:00");
        $I->click('Save', 'button');
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['logs/update?id=1']);
        $I->fillField(["name"=>'Logs[idUser]'],5);
        $I->fillField(["name"=>'Logs[idTipoAcao]'],2);
        $I->fillField(["name"=>'Logs[descricao]'],"O local de armazém 'Areeiro do Monte' foi criado.");
        $I->fillField(["name"=>'Logs[dataHora]'],"2022-11-02 18:08:00");
        $I->click('Save', 'button');
    }
}