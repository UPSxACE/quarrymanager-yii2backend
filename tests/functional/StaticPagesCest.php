<?php
class StaticPagesCest
{
    public function indexEquipaTest(\FunctionalTester $I)
    {
        $I->amOnPage(['equipa/']);
        $I->see('A Nossa Equipa!', 'h1');
    }
    public function indexParceirosTest(\FunctionalTester $I)
    {
        $I->amOnPage(['parceiros/']);
        $I->see('Nossos Parceiros!', 'h1');
    }
    public function indexPedreirasTest(\FunctionalTester $I)
    {
        $I->amOnPage(['pedreiras/']);
        $I->see('Pedreira', 'h1');
    }
    public function indexCriadoresTest(\FunctionalTester $I)
    {
        $I->amOnPage(['criadores/']);
        $I->see('Criadores!', 'h1');
    }
    public function indexFaqTest(\FunctionalTester $I)
    {
        $I->amOnPage(['faq/']);
        $I->see('FAQ!', 'h1');
    }
    public function historicoTest(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['perfil/historico']);
        $I->see('Histórico de Encomendas', 'h1');
    }
}