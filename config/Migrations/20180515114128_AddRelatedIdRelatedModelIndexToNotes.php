<?php
use Migrations\AbstractMigration;

class AddRelatedIdRelatedModelIndexToNotes extends AbstractMigration
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

        // Add index
        $table->addIndex(
            ['related_id', 'related_model'],
            ['name' => 'BY_RELATED_ID_AND_RELATED_MODEL', 'unique' => false]
        );

        $table->update();
    }
}
