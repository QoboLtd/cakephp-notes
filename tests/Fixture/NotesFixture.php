<?php
namespace Notes\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotesFixture
 *
 */
class NotesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'type' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'related_model' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'shared' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'content' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'related_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'trashed' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'primary_key' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => '00000000-0000-0000-0000-000000000001',
            'type' => 'success',
            'user_id' => '00000000-0000-0000-0000-000000000001',
            'related_model' => 'Foobar',
            'shared' => 'private',
            'content' => 'User 1 private note',
            'created' => '2016-04-11 14:51:59',
            'modified' => '2016-04-11 14:51:59',
            'related_id' => '1',
            'trashed' => null,
        ],
        [
            'id' => '00000000-0000-0000-0000-000000000002',
            'type' => 'success',
            'user_id' => '00000000-0000-0000-0000-000000000001',
            'related_model' => 'Foobar',
            'shared' => 'public',
            'content' => 'User 1 public note',
            'created' => '2016-04-11 14:51:59',
            'modified' => '2016-04-11 14:51:59',
            'related_id' => '1',
            'trashed' => null,
        ],
        [
            'id' => '00000000-0000-0000-0000-000000000003',
            'type' => 'success',
            'user_id' => '00000000-0000-0000-0000-000000000002',
            'related_model' => 'Foobar',
            'shared' => 'private',
            'content' => 'User 2 private note',
            'created' => '2016-04-11 14:51:59',
            'modified' => '2016-04-11 14:51:59',
            'related_id' => '1',
            'trashed' => null,
        ],
        [
            'id' => '00000000-0000-0000-0000-000000000004',
            'type' => 'success',
            'user_id' => '00000000-0000-0000-0000-000000000002',
            'related_model' => 'Foobar',
            'shared' => 'public',
            'content' => 'User 2 public note',
            'created' => '2016-04-11 14:51:59',
            'modified' => '2016-04-11 14:51:59',
            'related_id' => '1',
            'trashed' => null,
        ],
    ];
}
