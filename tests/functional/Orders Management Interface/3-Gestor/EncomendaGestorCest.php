<?php
require_once( __DIR__ . "/../2-Operario/EncomendaOperarioCest.php");
class EncomendaGestorCest extends EncomendaOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/encomendas']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Encomendas', 'h1');
    }

    public function actionInterfaceTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1']);
        $I->see("Encomenda #000001", "h1");
        $I->see("João");
        $I->see("Rua do Porto");
        $I->see("cliente@gmail.com");
        $I->see("Pedra Branca");
        $I->see("Pedido realizado em: 2022-04-22 23:17:13");
    }

    public function statusTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1']);
        $I->see("Recebido");
        $I->click("(forçar mudança de estado)");
        $I->see("Finalizado (Cliente apresentou feedback)");
    }

    public function cancelTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1']);
        $I->see("Recebido");
        $I->click("Cancelar Encomenda");
        $I->see("Encomendas");
        $I->amOnPage(['dashboard/encomendas/1']);
        $I->see("Cancelado (-)");
    }

    public function stepTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1']);
        $I->see("Recebido");
        $I->click("Cancelar Encomenda");
        $I->see("Encomendas");
        $I->amOnPage(['dashboard/encomendas/1']);
        $I->see("Cancelado (-)");
        $I->amOnPage(['dashboard/encomendas/1/step']);
        $I->see("Encomenda #000001", "h1");
    }

    public function mobilizacaoTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1/mobilizacao']);
        $I->see("Encomenda #000001", "h1");
        $I->see("Pedra Branca");
        $I->see("PDR_BRC_00002");
        $I->see("Sim", "td h4");
        $I->see("Agendar Recolha", "a");
    }

    public function agendarRecolhaTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1/mobilizacao']);
        $I->see("Encomenda #000001", "h1");
        $I->see("Pedra Branca");
        $I->click("Agendar Recolha", "a");
        $I->selectOption('PedidoLote[codigoLote]', array('value' => 'PDR_BRC_00001'));
        $I->fillField(["name"=>"PedidoLote[quantidade]"], "23.15");
        $I->selectOption('PedidoLote[idTransportadora]', array('text' => 'Unipessoal'));
        $I->click("Save");

        $I->seeCurrentUrlEquals('/dashboard/encomendas/1');
        $I->click("Mobilização do Stock", "a");

        $I->see("PDR_BRC_00001");
        $I->see("23.15");
        $I->see("Não", "td h4");
    }

    public function confirmarRecolhaTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1/mobilizacao']);
        $I->see("Encomenda #000001", "h1");
        $I->see("Pedra Branca");
        $I->click("Agendar Recolha", "a");
        $I->selectOption('PedidoLote[codigoLote]', array('value' => 'PDR_BRC_00001'));
        $I->fillField(["name"=>"PedidoLote[quantidade]"], "23.15");
        $I->selectOption('PedidoLote[idTransportadora]', array('text' => 'Unipessoal'));
        $I->click("Save");

        $I->seeCurrentUrlEquals('/dashboard/encomendas/1');
        $I->click("Mobilização do Stock", "a");

        $I->see("PDR_BRC_00001");
        $I->see("23.15");
        $I->see("Não", "td h4");
        $I->click("(Confirmar Recolha)", "a");

        $I->fillField(["name"=>"PedidoLote[matricula_Veiculo_recolha]"], "GGG-006");
        $I->click("Save");

        $I->see("Encomenda #000001", "h1");
        $I->seeCurrentUrlEquals('/dashboard/encomendas/1');

        $I->click("Mobilização do Stock", "a");
        $I->dontSee("Não", "td h4");
    }

    public function confirmarRecolhaAlreadyConfirmedTest(\FunctionalTester $I){
        $I->amOnPage(['dashboard/encomendas/1/mobilizacao']);
        $I->see("Encomenda #000001", "h1");
        $I->see("Pedra Branca");
        $I->click("Agendar Recolha", "a");
        $I->selectOption('PedidoLote[codigoLote]', array('value' => 'PDR_BRC_00001'));
        $I->fillField(["name"=>"PedidoLote[quantidade]"], "23.15");
        $I->selectOption('PedidoLote[idTransportadora]', array('text' => 'Unipessoal'));
        $I->click("Save");

        $I->seeCurrentUrlEquals('/dashboard/encomendas/1');
        $I->click("Mobilização do Stock", "a");

        $I->see("PDR_BRC_00001");
        $I->see("23.15");
        $I->see("Não", "td h4");
        $I->click("(Confirmar Recolha)", "a");

        $I->fillField(["name"=>"PedidoLote[matricula_Veiculo_recolha]"], "GGG-006");
        $I->click("Save");

        $I->see("Encomenda #000001", "h1");
        $I->seeCurrentUrlEquals('/dashboard/encomendas/1');

        $I->amOnPage("/dashboard/encomendas/1/mobilizacao/confirmar-recolha/4");
        $I->see("Encomendas", "h1");
        $I->seeCurrentUrlEquals('/dashboard/encomendas');
    }
}