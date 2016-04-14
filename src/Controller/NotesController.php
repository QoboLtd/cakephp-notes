<?php
namespace Notes\Controller;

use Cake\Network\Exception\UnauthorizedException;
use Notes\Controller\AppController;

/**
 * Notes Controller
 *
 * @property \Notes\Model\Table\NotesTable $Notes
 */
class NotesController extends AppController
{
    /**
     * My notes method
     *
     * @return \Cake\Network\Response|null
     */
    public function myNotes()
    {
        $notes = $this->Notes->find('all')
            ->where([
                'user_id' => $this->Auth->user('id')
            ])
            ->order([
                'modified' => 'DESC'
            ]);

        $notes = $this->paginate($notes);
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();

        $this->set(compact('notes', 'types', 'shared'));
        $this->set('_serialize', ['notes']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $notes = $this->Notes->find('all')
            ->contain([
                'Users'
            ])
            ->where([
                'Notes.user_id' => $this->Auth->user('id')
            ])
            ->orWhere([
                'Notes.shared' => $this->Notes->getPublicShared()
            ])
            ->order([
                'Notes.modified' => 'DESC'
            ]);

        $notes = $this->paginate($notes);
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();

        $this->set(compact('notes', 'types', 'shared'));
        $this->set('_serialize', ['notes']);
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Users']
        ]);

        $sharedPrivate = $this->Notes->getPrivateShared();
        /*
        if note is private and current user is not the owner, throw exception.
         */
        if ($note->shared === $sharedPrivate && $note->user_id !== $this->Auth->user('id')) {
            throw new UnauthorizedException();
        }

        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();

        $this->set(compact('note', 'types', 'shared'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['user_id'] = $this->Auth->user('id');
            $note = $this->Notes->patchEntity($note, $data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();
        $this->set(compact('note', 'types', 'shared'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => []
        ]);

        /*
        if current user is not the owner, throw exception.
         */
        if ($note->user_id !== $this->Auth->user('id')) {
            throw new UnauthorizedException();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();
        $this->set(compact('note', 'types', 'shared'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);

        /*
        if current user is not the owner, throw exception.
         */
        if ($note->user_id !== $this->Auth->user('id')) {
            throw new UnauthorizedException();
        }

        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
