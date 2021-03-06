<?php
/**
 * Copyright (c) Qobo Ltd. (https://www.qobo.biz)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Qobo Ltd. (https://www.qobo.biz)
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Notes\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
        'danger' => 'Red',
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
    protected $shared = [
        'private' => [
            'label' => 'Private',
            'icon' => 'eye-slash',
        ],
        'public' => [
            'label' => 'Public',
            'icon' => 'eye',
        ],
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

        $this->setTable('qobo_notes');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'CakeDC/Users.Users',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->requirePresence('user_id', 'create')
            ->notEmptyString('user_id');

        $validator
            ->allowEmptyString('related_model');

        $validator
            ->requirePresence('shared', 'create')
            ->notEmptyString('shared');

        $validator
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

        $validator
            ->uuid('related_id')
            ->allowEmptyString('related_id');

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
     * @return mixed[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * Returns Notes shared options.
     *
     * @return mixed[]
     */
    public function getShared(): array
    {
        return $this->shared;
    }

    /**
     * Return public shared option.
     *
     * @return string
     */
    public function getPublicShared(): string
    {
        return static::SHARED_PUBLIC;
    }

    /**
     * Return private shared option.
     *
     * @return string
     */
    public function getPrivateShared(): string
    {
        return static::SHARED_PRIVATE;
    }
}
