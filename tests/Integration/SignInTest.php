<?php

use Codeception\Actor;
use Codeception\Util\Fixtures;

class SignInTestCest
{
    public function _before(Actor $I)
    {
        // Prepare test environment if necessary
    }

    public function testSignInWithValidCredentials(Actor $I)
    {
        $I->amOnPage('../../src/components/signIn.php');
        $I->see('PokéDopt: Sign In');

        // Fill in form and submit
        $I->fillField('email', 'ashie.loche@pokedopt.com');
        $I->fillField('password', 'ThisIsMyPokedoptYIPPIE!!!<3');
        $I->checkOption('input[name="remember"]');
        $I->click('Submit');

        // Assert redirection and session
        $I->seeInCurrentUrl('../../src/pages/pokedopt.php');
        $I->see('Welcome, ashie.loche@pokedopt.com');
    }

    public function testSignInWithInvalidCredentials(Actor $I)
    {
        $I->amOnPage('../../src/components/signIn.php');
        $I->see('PokéDopt: Sign In');

        // Fill in form and submit
        $I->fillField('email', 'invalid@example.com');
        $I->fillField('password', 'wrongpassword');
        $I->click('Submit');

        // Assert redirection and error message
        $I->seeInCurrentUrl('../../src/pages/guest.php');
        $I->see('Incorrect username');
    }
}
