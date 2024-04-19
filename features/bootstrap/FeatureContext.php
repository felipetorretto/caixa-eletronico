<?php

use Behat\Behat\Context\Context;
use FelipeTorretto\ATM\Components\Withdraw\Domain\Account as AccountEntity;
use FelipeTorretto\ATM\Components\Withdraw\Infrastructure\Repositories\AccountRepository;
use FelipeTorretto\ATM\Models\Account as AccountModel;
use Illuminate\Database\Capsule\Manager as DB;

class FeatureContext implements Context
{
    protected $account;
    /**
     * @var Exception
     */
    private $exception;

    public function __construct()
    {
        // Connect to the database
        $capsule = new DB;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'db',
            'database' => 'atm',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    /**
     * @When /^uma conta com saldo de "([^"]*)"$/
     */
    public function umaContaComSaldoDe($arg1)
    {
        $this->account = new AccountModel();
        $this->account->balance = $arg1;
        $this->account->save();
    }

    /**
     * @When /^o cliente solicitar um saque de "([^"]*)"$/
     */
    public function oClienteSolicitarUmSaqueDe($arg1)
    {
        try {
            $repository = new AccountRepository();
            $account = new AccountEntity($this->account->id, $repository);
            $account->withdraw($arg1);
        } catch (Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * @When /^o saque deve ser autorizado$/
     */
    public function oSaqueDeveSerAutorizado()
    {
    }

    /**
     * @When /^o saldo da conta deve ser "([^"]*)"$/
     */
    public function oSaldoDaContaDeveSer($arg1)
    {
        $this->account->refresh();
        if ($this->account->balance != $arg1) {
            throw new Exception('Balance is not the expected value');
        }
    }

    /**
     * @When /^o saque deve ser negado$/
     */
    public function oSaqueDeveSerNegado()
    {
        if (is_null($this->exception)) {
            throw new Exception('Exception not thrown');
        }
    }
}
