<?php

namespace FelipeTorretto\ATM\Components\Withdraw\Infrastructure\Repositories;

use FelipeTorretto\ATM\Components\Withdraw\Domain\AccountRepositoryInterface;
use FelipeTorretto\ATM\Models\Account;

class AccountRepository implements AccountRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getBalance(int $id): int
    {
        $account = $this->getAccount($id);
        return $account->balance;
    }

    public function updateBalance(int $id, float $balance): void
    {
        $account = $this->getAccount($id);
        $account->balance = $balance;
        $account->save();
    }

    protected function getAccount(int $id): Account
    {
        /** @var Account $account */
        $account = Account::query()->find($id);
        return $account;
    }
}
