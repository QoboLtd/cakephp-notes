<?php
namespace Notes\View\Cell;

use Cake\View\Cell;

class NotesCell extends Cell
{
    /**
     * Pass record specific notes to the View, based on current user and visibility.
     *
     * @param  string $model model name
     * @param  string $recordId record id
     * @return void
     */
    public function recordNotes($model, $recordId)
    {
        $currentUser = $this->request->session()->read('Auth.User');
        $this->loadModel('Notes.Notes');
        $notes = $this->Notes->find('all')
            ->where([
                'user_id' => $currentUser['id']
            ])
            ->orWhere([
                'shared' => $this->Notes->getPublicShared()
            ])
            ->andWhere([
                'model' => $model,
                'primary_key' => $recordId
            ])
            ->order([
                'modified' => 'DESC'
            ]);
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();

        $this->set(compact('currentUser', 'notes', 'types', 'shared'));
    }
}
