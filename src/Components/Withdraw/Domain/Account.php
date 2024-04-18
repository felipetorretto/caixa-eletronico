<?php

namespace FelipeTorretto\ATM\Components\Withdraw\Domain;

use Exception;

class Account
{
    protected $id;
    protected $accountRepository;

    public function __construct(int $id, AccountRepository $accountRepository)
    {
        $this->id = $id;
        $this->accountRepository = $accountRepository;
    }

    public function getBalance(): float
    {
        return $this->accountRepository->getBalance($this->id);
    }

    /**
     * @throws Exception
     */
    public function withdraw(int $value): void
    {
        $balance = $this->getBalance();

        if ($balance < $value) {
            throw new Exception('Insufficient funds');
        }

        $balance -= $value;
        $this->accountRepository->updateBalance($this->id, $balance);
    }
}
