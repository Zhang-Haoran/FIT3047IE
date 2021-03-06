<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Accessories Controller
 *
 * @property \App\Model\Table\AccessoriesTable $Accessories
 *
 * @method \App\Model\Entity\Accessory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccessoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if($this->Auth->user('access_level')=='3'){
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            return $this->redirect($this->Auth->redirectUrl());
        }

        $accessories = $this->Accessories->find('all');

        $this->set(compact('accessories'));
    }

    /**
     * View method
     *
     * @param string|null $id Accessory id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->Auth->user('access_level')=='3'){
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            return $this->redirect($this->Auth->redirectUrl());
        }

        $accessory = $this->Accessories->get($id, [
            'contain' => []
        ]);

        $this->set('accessory', $accessory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->Auth->user('access_level')=='3'){
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            return $this->redirect($this->Auth->redirectUrl());
        }

        $accessory = $this->Accessories->newEntity();
        if ($this->request->is('post')) {
            $accessory = $this->Accessories->patchEntity($accessory, $this->request->getData());
            if ($this->Accessories->save($accessory)) {
                $this->Flash->success(__('The accessory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accessory could not be saved. Please, try again.'));
        }
        $this->set(compact('accessory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Accessory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->Auth->user('access_level')=='3'){
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            return $this->redirect($this->Auth->redirectUrl());
        }

        $accessory = $this->Accessories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessory = $this->Accessories->patchEntity($accessory, $this->request->getData());
            if ($this->Accessories->save($accessory)) {
                $this->Flash->success(__('The accessory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accessory could not be saved. Please, try again.'));
        }
        $this->set(compact('accessory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Accessory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->Auth->user('access_level')=='3'){
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            return $this->redirect($this->Auth->redirectUrl());
        }

        $this->request->allowMethod(['post', 'delete']);
        $accessory = $this->Accessories->get($id);
        if ($this->Accessories->delete($accessory)) {
            $this->Flash->success(__('The accessory has been deleted.'));
        } else {
            $this->Flash->error(__('The accessory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
