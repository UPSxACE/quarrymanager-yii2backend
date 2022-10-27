<?php
require_once( __DIR__ . "/../LojaCest.php");
class LojaClienteCest extends LojaCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['loja/']);
    }

    public function comprarTest(\FunctionalTester $I)
    {
        $I->amOnPage(['loja/produto/4']);
        $I->see('Enviar', 'button');
        $I->fillField(["name"=>'Pedido[quantidade]'],10);
        $I->fillField(["name"=>'Pedido[codigo_desconto]'], 1234);
        $I->fillField(["name"=>'Pedido[mensagem]'], "abc");
        $I->click("Enviar");
        $I->see('Pedido de orçamento enviado.');
    }
}
