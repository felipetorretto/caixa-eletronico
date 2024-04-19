<?php

namespace FelipeTorretto\ATM\Components\Withdraw\Domain;

interface AccountRepositoryInterface
{
    /**
     * @param int $id
     * @return int The balance in cents, e.g. 10000 for R$ 100,00
     */
    public function getBalance(int $id): int;

    public function updateBalance(int $id, float $balance): void;
}
