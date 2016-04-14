<?php
namespace Notes\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Notes\Model\Table\NotesTable;

/**
 * Notes\Model\Table\NotesTable Test Case
 */
class NotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Notes\Model\Table\NotesTable
     */
    public $Notes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.notes.notes',
        'plugin.notes.users',
        'plugin.notes.phinxlog',
        'plugin.notes.notes_phinxlog'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Notes') ? [] : ['className' => 'Notes\Model\Table\NotesTable'];
        $this->Notes = TableRegistry::get('Notes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Notes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
