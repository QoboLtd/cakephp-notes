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
namespace Notes\View\Cell;

use Cake\View\Cell;

/**
 * Notes Cell
 *
 * @property \Notes\Model\Table\NotesTable $Notes
 */
class NotesCell extends Cell
{
    /**
     * Pass record specific notes to the View, based on current user and visibility.
     *
     * @param  string $relatedModel related model name
     * @param  string $relatedId related record id
     * @return void
     */
    public function form(string $relatedModel, string $relatedId): void
    {
        $currentUser = $this->request->session()->read('Auth.User');
        $this->loadModel('Notes.Notes');
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();

        $this->set(compact('relatedModel', 'relatedId', 'types', 'shared'));
    }
    /**
     * Pass record specific notes to the View, based on current user and visibility.
     *
     * @param  string $relatedModel related model name
     * @param  string $relatedId related record id
     * @return void
     */
    public function listing(string $relatedModel, string $relatedId): void
    {
        $currentUser = (array)$this->request->session()->read('Auth.User');
        $this->loadModel('Notes.Notes');
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();
        /**
         * @var \Cake\ORM\Query $notes
         */
        $notes = $this->Notes->find('all')
            ->where([
                'AND' => [
                    ['Notes.related_model' => $relatedModel, 'Notes.related_id' => $relatedId],
                    'OR' => [
                        ['Notes.user_id' => $currentUser['id']],
                        ['Notes.shared' => $this->Notes->getPublicShared()]
                    ]
                ]
            ])
            ->order(['Notes.modified' => 'DESC'])
            ->contain(['Users']);
        $notes = $notes->all();

        $this->set(compact('relatedModel', 'relatedId', 'types', 'shared', 'notes'));
    }
}
