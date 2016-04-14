<?php
use Migrations\AbstractMigration;

class RenameModelAndPrimaryKeyFields extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('notes');
        $table->renameColumn('model', 'related_model');
        $table->renameColumn('primary_key', 'related_id');
        $table->update();
    }
}
