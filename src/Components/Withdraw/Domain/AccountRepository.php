<?php

namespace FelipeTorretto\ATM\Components\Withdraw\Domain;

interface AccountRepository
{
    public function getBalance(int $id): float;

    public function updateBalance(int $id, float $balance): void;
}
