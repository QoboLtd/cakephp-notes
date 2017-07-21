<?php
namespace Notes\View\Cell;

use Cake\View\Cell;

class NotesCell extends Cell
{
    /**
     * Pass record specific notes to the View, based on current user and visibility.
     *
     * @param  string $relatedModel related model name
     * @param  string $relatedId related record id
     * @return void
     */
    public function form($relatedModel, $relatedId)
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
    public function listing($relatedModel, $relatedId)
    {
        $currentUser = $this->request->session()->read('Auth.User');
        $this->loadModel('Notes.Notes');
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();
        $notes = $this->Notes->find('all')
            ->contain([
                'Users'
            ])
            ->where([
                'Notes.user_id' => $currentUser['id']
            ])
            ->orWhere([
                'Notes.shared' => $this->Notes->getPublicShared()
            ])
            ->andWhere([
                'Notes.related_model' => $relatedModel,
                'Notes.related_id' => $relatedId
            ])
            ->order([
                'Notes.modified' => 'DESC'
            ])->all();

        $this->set(compact('relatedModel', 'relatedId', 'types', 'shared', 'notes'));
    }
}
