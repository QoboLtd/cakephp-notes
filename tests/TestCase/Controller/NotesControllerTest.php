<?php
namespace Notes\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use Notes\Controller\NotesController;

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

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => '00000000-0000-0000-0000-000000000001',
                ],
            ],
        ]);
        $this->get('/notes/notes');
        $this->assertResponseOk();
        $this->assertResponseContains('User 1 private note');
        $this->assertResponseContains('User 1 public note');
        $this->assertResponseNotContains('User 2 private note');
        $this->assertResponseContains('User 2 public note');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => '00000000-0000-0000-0000-000000000001',
                ],
            ],
        ]);
        $this->get('/notes/notes/view/00000000-0000-0000-0000-000000000001');
        $this->assertResponseOk();
        $this->get('/notes/notes/view/00000000-0000-0000-0000-000000000002');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => '00000000-0000-0000-0000-000000000001',
                ],
            ],
        ]);
        $this->get('/notes/notes/add');
        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => '00000000-0000-0000-0000-000000000001',
                ],
            ],
        ]);
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
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => '00000000-0000-0000-0000-000000000001',
                ],
            ],
        ]);
        $this->post('/notes/notes/delete/00000000-0000-0000-0000-000000000001');
        $this->assertRedirect();
        $this->post('/notes/notes/delete/00000000-0000-0000-0000-000000000002');
        $this->assertRedirect();
    }
}
