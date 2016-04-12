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
    protected $_types = [
        'yellow',
        'blue',
        'red',
        'green'
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
        'private',
        'public'
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
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->allowEmpty('model');

        $validator
            ->requirePresence('shared', 'create')
            ->notEmpty('shared');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->uuid('primary_key')
            ->allowEmpty('primary_key');

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
        $result = array_combine($this->_types, array_map(function ($v) {
            return Inflector::humanize($v);
        }, $this->_types));

        return $result;
    }

    /**
     * Returns Notes shared options.
     *
     * @return array
     */
    public function getShared()
    {
        $result = array_combine($this->_shared, array_map(function ($v) {
            return Inflector::humanize($v);
        }, $this->_shared));

        return $result;
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

    /**
     * Finder method that returns records by owner.
     * @param  Query  $query   Query object
     * @param  array  $options Options
     * @return Query
     */
    public function findOwnedBy(Query $query, array $options)
    {
        return $query->where(['user_id' => $options['user_id']]);
    }
}
