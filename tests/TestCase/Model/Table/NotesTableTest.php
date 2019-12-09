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
        /**
         * @var \Notes\Model\Table\NotesTable $notes
         */
        $notes = TableRegistry::get('Notes', $config);
        $this->Notes = $notes;
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

    public function testValidationDefault(): void
    {
        $validator = new \Cake\Validation\Validator();
        $result = $this->Notes->validationDefault($validator);

        $this->assertInstanceOf('\Cake\Validation\Validator', $result);

        $data = [
            'type' => 'success',
            'shared' => 'public',
            'content' => 'Foobar',
            'user_id' => '00000000-0000-0000-0000-000000000001',
        ];

        $entity = $this->Notes->newEntity($data);

        $this->assertEmpty($entity->getErrors());
    }

    public function testSave(): void
    {
        $data = [
            'type' => 'success',
            'shared' => 'public',
            'content' => 'Foobar',
            'user_id' => '00000000-0000-0000-0000-000000000001',
        ];

        $entity = $this->Notes->newEntity($data);
        /**
         * @var \Notes\Model\Entity\Note $result
         */
        $result = $this->Notes->save($entity);

        $this->assertNotEmpty($result->get('id'));
    }

    public function testGetTypes(): void
    {
        $result = $this->Notes->getTypes();
        $this->assertTrue(is_array($result), "getTypes() returns a non-array");
        $this->assertFalse(empty($result), "getTypes() returns an empty result");
        $this->assertArrayHasKey('warning', $result, "'warning' is not in returned types");
        $this->assertArrayHasKey('info', $result, "'info' is not in returned types");
        $this->assertArrayHasKey('danger', $result, "'danger' is not in returned types");
        $this->assertArrayHasKey('success', $result, "'success' is not in returned types");
    }

    public function testGetShared(): void
    {
        $result = $this->Notes->getShared();
        $this->assertTrue(is_array($result), "getShared() returns a non-array");
        $this->assertFalse(empty($result), "getShared() returns an empty result");
        $this->assertArrayHasKey('private', $result, "'Private' is not in returned shared values");
        $this->assertArrayHasKey('public', $result, "'Public' is not in returned shared values");
    }

    public function testGetPublicShared(): void
    {
        $result = $this->Notes->getPublicShared();
        $this->assertEquals('public', $result);
    }

    public function testGetPrivateShared(): void
    {
        $result = $this->Notes->getPrivateShared();
        $this->assertEquals('private', $result);
    }
}
