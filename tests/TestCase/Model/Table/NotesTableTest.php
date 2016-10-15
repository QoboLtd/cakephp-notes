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

    public function testGetTypes()
    {
        $result = $this->Notes->getTypes();
        $this->assertTrue(is_array($result), "getTypes() returns a non-array");
        $this->assertFalse(empty($result), "getTypes() returns an empty result");
        $this->assertArrayHasKey('warning', $result, "'warning' is not in returned types");
        $this->assertArrayHasKey('info', $result, "'info' is not in returned types");
        $this->assertArrayHasKey('danger', $result, "'danger' is not in returned types");
        $this->assertArrayHasKey('success', $result, "'success' is not in returned types");
    }

    public function testGetShared()
    {
        $result = $this->Notes->getShared();
        $this->assertTrue(is_array($result), "getShared() returns a non-array");
        $this->assertFalse(empty($result), "getShared() returns an empty result");
        $this->assertContains('Private', $result, "'Private' is not in returned shared values");
        $this->assertContains('Public', $result, "'Public' is not in returned shared values");
    }

    public function testGetPublicShared()
    {
        $result = $this->Notes->getPublicShared();
        $this->assertEquals('public', $result);
    }

    public function testGetPrivateShared()
    {
        $result = $this->Notes->getPrivateShared();
        $this->assertEquals('private', $result);
    }
}
