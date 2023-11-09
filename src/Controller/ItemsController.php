<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $item = $this->Items->newEmptyEntity();
        
        $categories = $this->Items->Categories->find('list')->all();
        $units = $this->Items->Units->find('list')->all();

        $this->set(compact('item', 'categories', 'units'));
    }

    public function getItems()
    {
        $items = $this->Items->find()
        ->contain(['Categories', 'Units'])
        ->toArray();

        return $this->response->withType('application/json')
        ->withStringBody(json_encode(['data'=>$items]));
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => ['Categories', 'Units'],
        ]);

        $this->set(compact('item'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $item = $this->Items->newEmptyEntity();

        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->getData());

            if ($this->Items->save($item)) {
                $result = ['result' => 'success', 'message' => 'The item has been saved.'];
            } else {
                $result = ['result' => 'error', 'message' => 'The item could not be saved. Please try again.'];
            }
            return $this->response = $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
        }
        $categories = $this->Items->Categories->find('list', ['limit' => 200])->all();
        $units = $this->Items->Units->find('list', ['limit' => 200])->all();

        $this->set(compact('item', 'categories', 'units'));
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $result = ['result'=>'success','message'=>'The item has been updated.'];
            } else {
                $result = ['result'=>'error','message'=>'The item could not be updated. Please try again.'];
            }
            return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
        }
        return $this->response->withType('application/json')
        ->withStringBody(json_encode($item));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $result = ['result'=>'success','message'=>'The item has been deleted.'];
        } else {
            $result = ['result'=>'error','message'=>'The item could not be deleted. Please try again.'];
        }
        return $this->response->withType('application/json')
        ->withStringBody(json_encode($result));
    }
}
