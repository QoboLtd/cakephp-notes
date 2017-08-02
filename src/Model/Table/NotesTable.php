<?php
namespace Notes\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Inflector;
use Cake\Validation\Validator;
use Notes\Model\Entity\Note;

/**
 * Notes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsToMany $Phinxlog
 */
class NotesTable extends Table
{
    /**
     * Notes types
     *
     * @var array
     */
    protected $types = [
        'info' => 'Blue',
        'success' => 'Green',
        'warning' => 'Yellow',
        'danger' => 'Red'
    ];

    /**
     * Shared option private value
     */
    const SHARED_PRIVATE = 'private';

    /**
     * Shared option public value
     */
    const SHARED_PUBLIC = 'public';

    /**
     * Notes shared options
     *
     * @var array
     */
    protected $_shared = [
        'private' => [
            'label' => 'Private',
            'icon' => 'eye-slash'
        ],
        'public' => [
            'label' => 'Public',
            'icon' => 'eye'
        ]
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('notes');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'CakeDC/Users.Users'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->allowEmpty('related_model');

        $validator
            ->requirePresence('shared', 'create')
            ->notEmpty('shared');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->uuid('related_id')
            ->allowEmpty('related_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    /**
     * Returns Notes types.
     *
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Returns Notes shared options.
     *
     * @return array
     */
    public function getShared()
    {
        return $this->_shared;
    }

    /**
     * Return public shared option.
     *
     * @return string
     */
    public function getPublicShared()
    {
        return static::SHARED_PUBLIC;
    }

    /**
     * Return private shared option.
     *
     * @return string
     */
    public function getPrivateShared()
    {
        return static::SHARED_PRIVATE;
    }
}
