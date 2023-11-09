<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Requestdetails Controller
 *
 * @property \App\Model\Table\RequestdetailsTable $Requestdetails
 * @method \App\Model\Entity\Requestdetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequestdetailsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->viewBuilder()->setLayout('admin');
        parent::beforeFilter($event); // TODO: Change the autogenerated stub
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Requests', 'Items'],
        ];
        $requestdetails = $this->paginate($this->Requestdetails);

        $this->set(compact('requestdetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Requestdetail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestdetail = $this->Requestdetails->get($id, [
            'contain' => ['Requests', 'Items'],
        ]);

        $this->set(compact('requestdetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requestdetail = $this->Requestdetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $requestdetail = $this->Requestdetails->patchEntity($requestdetail, $this->request->getData());
            if ($this->Requestdetails->save($requestdetail)) {
                $this->Flash->success(__('The requestdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requestdetail could not be saved. Please, try again.'));
        }
        $requests = $this->Requestdetails->Requests->find('list', ['limit' => 200])->all();
        $items = $this->Requestdetails->Items->find('list', ['limit' => 200])->all();
        $this->set(compact('requestdetail', 'requests', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Requestdetail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestdetail = $this->Requestdetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestdetail = $this->Requestdetails->patchEntity($requestdetail, $this->request->getData());
            if ($this->Requestdetails->save($requestdetail)) {
                $this->Flash->success(__('The requestdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requestdetail could not be saved. Please, try again.'));
        }
        $requests = $this->Requestdetails->Requests->find('list', ['limit' => 200])->all();
        $items = $this->Requestdetails->Items->find('list', ['limit' => 200])->all();
        $this->set(compact('requestdetail', 'requests', 'items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Requestdetail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestdetail = $this->Requestdetails->get($id);
        if ($this->Requestdetails->delete($requestdetail)) {
            $this->Flash->success(__('The requestdetail has been deleted.'));
        } else {
            $this->Flash->error(__('The requestdetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}