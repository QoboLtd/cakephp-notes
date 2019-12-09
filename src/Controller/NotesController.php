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
namespace Notes\Controller;

use Cake\Http\Exception\UnauthorizedException;
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
     * @return \Cake\Http\Response|void|null
     */
    public function myNotes()
    {
        /**
         * @var \Cake\ORM\Query $notes
         */
        $notes = $this->Notes->find('all')
            ->where(['Notes.user_id' => $this->Auth->user('id')])
            ->order(['Notes.modified' => 'DESC'])
            ->contain(['Users']);

        $notes = $this->paginate($notes);
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();

        $this->set(compact('notes', 'types', 'shared'));
        $this->set('_serialize', ['notes']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void|null
     */
    public function index()
    {
        /**
         * @var \Cake\ORM\Query $notes
         */
        $notes = $this->Notes->find('all')
            ->where([
                'OR' => [
                    'Notes.user_id' => $this->Auth->user('id'),
                    'Notes.shared' => $this->Notes->getPublicShared(),
                ],
            ])
            ->order(['Notes.modified' => 'DESC'])
            ->contain(['Users']);

        $notes = $this->paginate($notes);
        $types = $this->Notes->getTypes();
        $shared = $this->Notes->getShared();

        $this->set(compact('notes', 'types', 'shared'));
        $this->set('_serialize', ['notes']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {
            $data = (array)$this->request->getData();
            $data['user_id'] = $this->Auth->user('id');
            $note = $this->Notes->patchEntity($note, $data);
            if ($this->Notes->save($note)) {
                $this->Flash->success((string)__('The note has been saved.'));
                $redirectUrl = $this->referer();
                // @todo handle this better, probably get rid of add View and redirect always back to referer
                if (\Cake\Routing\Router::url('/', true) . $this->request->getPath() === $this->referer()) {
                    $this->redirect(['action' => 'my-notes']);
                }

                return $this->redirect($redirectUrl);
            } else {
                $this->Flash->error((string)__('The note could not be saved. Please, try again.'));
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
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit(string $id = null)
    {
        /**
         * @var \Notes\Model\Entity\Note $note
         */
        $note = $this->Notes->get($id, [
            'contain' => [],
        ]);

        /*
        if current user is not the owner, throw exception.
         */
        if ($note->user_id !== $this->Auth->user('id')) {
            throw new UnauthorizedException();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = is_array($this->request->getData()) ? $this->request->getData() : [];
            $note = $this->Notes->patchEntity($note, $data);
            if ($this->Notes->save($note)) {
                $this->Flash->success((string)__('The note has been saved.'));
                $this->redirect(['action' => 'my-notes']);
            } else {
                $this->Flash->error((string)__('The note could not be saved. Please, try again.'));
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
     * @return \Cake\Http\Response|void|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        /**
         * @var \Notes\Model\Entity\Note $note
         */
        $note = $this->Notes->get($id);

        /*
        if current user is not the owner, throw exception.
         */
        if ($note->user_id !== $this->Auth->user('id')) {
            throw new UnauthorizedException();
        }

        if ($this->Notes->delete($note)) {
            $this->Flash->success((string)__('The note has been deleted.'));
        } else {
            $this->Flash->error((string)__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->request->referer());
    }
}
