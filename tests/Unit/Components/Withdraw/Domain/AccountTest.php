<?php

namespace Tests\Unit\Components\Withdraw\Domain;

use Exception;
use FelipeTorretto\ATM\Components\Withdraw\Domain\Account;
use FelipeTorretto\ATM\Components\Withdraw\Domain\AccountRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testGetBalance()
    {
        // arrange
        $mock = Mockery::mock(AccountRepository::class)
            ->shouldReceive('getBalance')
            ->andReturn(100)
            ->getMock();
        $sut = new Account(1, $mock);

        // act
        $balance = $sut->getBalance();

        // assert
        $this->assertEquals(100, $balance);
    }

    public function testWithdrawWhenTheAccountHasEnoughBalance()
    {
        // arrange
        $mock = Mockery::mock(AccountRepository::class)
            ->shouldReceive('getBalance')->andReturn(100)->getMock()
            ->shouldReceive('updateBalance')->with(1, 0)->getMock();
        $sut = new Account(1, $mock);

        // act
        $sut->withdraw(100);

        // assert
        $this->assertTrue(true);
    }

    public function testWithdrawWhenTheAccountDoesntHaveEnoughBalance()
    {
        // exception expectation
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Insufficient funds');

        // arrange
        $mock = Mockery::mock(AccountRepository::class)
            ->shouldReceive('getBalance')->andReturn(100)->getMock();
        $sut = new Account(1, $mock);

        // act
        $sut->withdraw(101);

        // assert
        $mock->shouldNotHaveReceived('updateBalance');
        $this->assertTrue(true);
    }
}
