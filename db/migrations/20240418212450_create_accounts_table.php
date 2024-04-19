<?php

use Phinx\Migration\AbstractMigration;

class CreateAccountsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('accounts');
        $table->addColumn('balance', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();
    }
}
