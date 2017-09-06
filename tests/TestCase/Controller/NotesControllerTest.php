<?php
namespace Notes\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\Network\Exception\UnauthorizedException;

/**
 * Notes\Controller\NotesController Test Case
 */
class NotesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.notes.notes',
        'plugin.notes.users',
    ];

    public function setUp()
    {
        parent::setUp();

        $this->session([
            'Auth' => [
                'User' => [
                    'id' => '00000000-0000-0000-0000-000000000001',
                ],
            ],
        ]);

        $this->enableRetainFlashMessages();

        $this->NotesTable = TableRegistry::get('Notes.Notes');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/notes/notes');
        $this->assertResponseOk();
        $this->assertResponseContains('User 1 private note');
        $this->assertResponseContains('User 1 public note');
        $this->assertResponseNotContains('User 2 private note');
        $this->assertResponseContains('User 2 public note');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            'type' => 'success',
            'user_id' => '00000000-0000-0000-0000-000000000001',
            'related_model' => 'Foobar',
            'shared' => 'public',
            'content' => 'User 1 public note Add',
        ];
        $this->post('/notes/notes/add', $data);

        $this->assertResponseSuccess();
        $this->assertRedirect();
        $this->assertRedirectContains('/');
        $this->assertSession('The note has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test AddWrongData method
     *
     * @return void
     */
    public function testAddWrongData()
    {
        $data = [
            'type' => 'success',
            'user_id' => '00000000-0000-0000-0000-000000000001',
            'related_model' => 'Foobar',
            'shared' => 'public',
            'content' => 'User 1 public note Add',
            'related_id' => 'WRONG ID'
        ];
        $this->post('/notes/notes/add', $data);

        $this->assertResponseSuccess();
        $this->assertSession('The note could not be saved. Please, try again.', 'Flash.flash.0.message');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('/notes/notes/edit/00000000-0000-0000-0000-000000000001');
        $this->assertResponseOk();
        $this->get('/notes/notes/edit/00000000-0000-0000-0000-000000000002');
        $this->assertResponseOk();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $id = '00000000-0000-0000-0000-000000000001';

        $this->delete('/notes/notes/delete/' . $id);

        $this->assertResponseCode(302);

        $query = $this->NotesTable->find()->where(['id' => '00000000-0000-0000-0000-000000000001']);

        $this->assertTrue($query->isEmpty());
    }

    /**
     * Test Unauthorized User delete method
     *
     * @return void
     */
    public function testDeleteUnauthorizedUser()
    {
        $id = '00000000-0000-0000-0000-000000000003';
        $this->delete('/notes/notes/delete/' . $id);
        $this->assertResponseError();
        $this->assertSame(401, $this->_response->getStatusCode());
    }
}
