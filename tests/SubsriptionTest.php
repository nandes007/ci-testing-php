<?php

namespace Tests;
use App\Gateway;
use PHPUnit\Framework\TestCase;

use App\Subsription;
use App\User;
use App\Mailer;

class SubsriptionTest extends TestCase
{
    /**
     * @test
     */
    function it_creates_a_stripe_subscription()
    {
        $this->markTestSkipped();
    }

    /**
     * @test
     */
    function creating_a_subscription_marks_the_user_as_subscribed()
    {
        $gateway = new FakeGateway(); // don't use the actual Gateway. Use dummy/fake version.
        $mailer = new Mailer();
        $subscription = new Subsription($gateway, $mailer);
        $user = new User('Steven');

        $this->assertFalse($user->isSubscribed());

        $subscription->create($user);

        $this->assertTrue($user->isSubscribed());
    }

    /**
     * @test
     */
    function creating_a_subscription_marks_the_user_as_subscribed_with_mock()
    {
        $subscription = new Subsription($this->createMock(Gateway::class), $this->createMock(Mailer::class));
        $user = new User('Steven');

        $this->assertFalse($user->isSubscribed());

        $subscription->create($user);

        $this->assertTrue($user->isSubscribed());
    }

    /**
     * @test
     */
    function creating_a_subscription_marks_the_user_as_subscribed_with_stub()
    {
        $subscription = new Subsription(new GatewayStub(), new Mailer());
        $user = new User('Steven');

        $this->assertFalse($user->isSubscribed());

        $subscription->create($user);

        $this->assertTrue($user->isSubscribed());
    }

    /**
     * @test
     */
    function it_delivery_a_receipt()
    {
        $gateway = $this->createMock(Gateway::class);
        $gateway->method('create')->willReturn('receipt-stub');

        $mailer = $this->createMock(Mailer::class);
        $mailer
            ->expects($this->once())
            ->method('deliver')
            ->with('Your receipt number is: receipt-stub');

        $subscription = new Subsription($gateway, $mailer);

        $subscription->create(new User("Steven"));
    }
}
