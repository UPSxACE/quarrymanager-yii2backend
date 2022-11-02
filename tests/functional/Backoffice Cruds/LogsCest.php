<?php

class LogsCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['logs/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Logs', 'h1');
    }

    public function createTest(\FunctionalTester $I)
    {
        $I->amOnPage(['logs/create']);
        $I->see("Create Logs");
        $I->fillField(["name"=>'Logs[idUser]'],1);
        $I->fillField(["name"=>'Logs[idTipoAcao]'],2);
        $I->fillField(["name"=>'Logs[descricao]'],"O local de armazém 'Areeiro de Bragança' foi criado.");
        $I->fillField(["name"=>'Logs[dataHora]'],"2022-11-02 14:29:00");
        $I->click('Save', 'button');
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['logs/update?id=67']);
        $I->fillField(["name"=>'Logs[idUser]'],1);
        $I->fillField(["name"=>'Logs[idTipoAcao]'],2);
        $I->fillField(["name"=>'Logs[descricao]'],"O local de armazém 'Areeiro de Bragança' foi criado.123");
        $I->fillField(["name"=>'Logs[dataHora]'],"2022-11-02 15:07:00");
        $I->click('Save', 'button');
    }
}