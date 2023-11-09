<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Inventories Controller
 *
 * @property \App\Model\Table\InventoriesTable $Inventories
 * @method \App\Model\Entity\Inventory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InventoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $inventory = $this->Inventories->newEmptyEntity();
        
        $items = $this->Inventories->Items->find('list')->all();

        $this->set(compact('inventory', 'items'));
    }

    public function getInventories()
    {
        $inventories = $this->Inventories->find()
        ->contain(['Items'])
        ->toArray();

        return $this->response->withType('application/json')
        ->withStringBody(json_encode(['data'=>$inventories]));
    }

    /**
     * View method
     *
     * @param string|null $id Inventory id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventory = $this->Inventories->get($id, [
            'contain' => ['Items'],
        ]);

        $this->set(compact('inventory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inventory = $this->Inventories->newEmptyEntity();

        if ($this->request->is('post')) {
            $inventory = $this->Inventories->patchEntity($inventory, $this->request->getData());

            if ($this->Inventories->save($inventory)) {
                $result = ['result' => 'success', 'message' => 'The inventory has been saved.'];
            } else {
                $result = ['result' => 'error', 'message' => 'The inventory could not be saved. Please try again.'];
            }
            return $this->response = $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
        }
        $items = $this->Inventories->Items->find('list', ['limit' => 200])->all();
        $this->set(compact('inventory', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inventory = $this->Inventories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventory = $this->Inventories->patchEntity($inventory, $this->request->getData());
            if ($this->Inventories->save($inventory)) {
                $result = ['result'=>'success','message'=>'The inventory has been updated.'];
            } else {
                $result = ['result'=>'error','message'=>'The inventory could not be updated. Please try again.'];
            }
            return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
        }
        return $this->response->withType('application/json')
        ->withStringBody(json_encode($inventory));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inventory = $this->Inventories->get($id);
        if ($this->Inventories->delete($inventory)) {
            $result = ['result'=>'success','message'=>'The inventory has been deleted.'];
        } else {
            $result = ['result'=>'error','message'=>'The inventory could not be deleted. Please try again.'];
        }
        return $this->response->withType('application/json')
        ->withStringBody(json_encode($result));
    }
}
