<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidSolutionCatalysts\PayPal\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Page\Checkout\Basket as BasketPage;
use OxidSolutionCatalysts\PayPal\Tests\Codeception\AcceptanceTester;
use Codeception\Util\Fixtures;
use OxidEsales\Codeception\Page\Checkout\ThankYou;
use OxidEsales\Codeception\Step\Basket;
use OxidEsales\Codeception\Page\Checkout\PaymentCheckout;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Step\ProductNavigation;

/**
 * @group osc_paypal
 * @group osc_paypal_proxy
 * @group osc_paypal_remote_login
 */
final class ProxyControllerCest extends BaseCest
{
    public function testRepeatedCreateOrderCallNotAllowedWithSession(AcceptanceTester $I): void
    {
        $I->wantToTest('calling proxy createOrder only creates one PayPal order per session');

        $this->enableExpressButtons($I);
        $I->dontSeeCookie('sid');
        $I->dontSeeCookie('sid_key');

        //send this as post request
        $I->postTo(
            $this->getShopUrl() . '/index.php?cl=oscpaypalproxy&fnc=createOrder&context=continue&aid=' . Fixtures::get('product')['oxid']
        );

        $response = $I->grabJsonResponseAsArray();
        $paypalOrderId = $response['id'];
        $I->assertNotEmpty($paypalOrderId);
        $sid = $I->extractSidFromResponseCookies();
        $I->assertNotEmpty($sid);

        $I->postTo(
            $this->getShopUrl() . '/index.php?cl=oscpaypalproxy&fnc=createOrder&context=continue&aid=' . Fixtures::get('product')['oxid'],
            ['Cookie' => 'language=0; sid=' . $sid . ';sid_key=oxid']
        );
        $response = $I->grabJsonResponseAsArray();
        $I->assertSame(['ERROR' => 'PayPal session already started.'], $response);

        //retry but do not send sid cookie, a new session will be started with new PayPal order
        $I->clearShopCache();
        $I->postTo(
            $this->getShopUrl() . '/index.php?cl=oscpaypalproxy&fnc=createOrder&context=continue&aid=' . Fixtures::get('product')['oxid']
        );
        $response = $I->grabJsonResponseAsArray();
        $I->assertNotEquals($paypalOrderId, $response['id']);
        $I->assertNotEquals($sid,$I->extractSidFromResponseCookies());
    }
}


