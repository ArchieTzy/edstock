<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Heads Controller
 *
 * @property \App\Model\Table\HeadsTable $Heads
 * @method \App\Model\Entity\Head[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HeadsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $head = $this->Heads->newEmptyEntity();
        $this->set(compact('head'));
    }

    public function getHeads()
    {
        $head= $this->Heads->find();
        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['data'=>$head]));
    }

    /**
     * View method
     *
     * @param string|null $id Head id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $head = $this->Heads->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('head'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $head = $this->Heads->newEmptyEntity();
        if ($this->request->is('post')) {
            $head = $this->Heads->patchEntity($head, $this->request->getData());
            if ($this->Heads->save($head)) {
                $result = ['result'=>'success','message'=>'The head has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The head could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        $this->set(compact('head'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Head id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $head = $this->Heads->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $head = $this->Heads->patchEntity($head, $this->request->getData());
            if ($this->Heads->save($head)) {
                $result = ['result'=>'success','message'=>'The head has been updated.'];
            } else {
                $result = ['result'=>'error','message'=>'The head could not be updated. Please try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($head));
    }

    /**
     * Delete method
     *
     * @param string|null $id Head id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $head = $this->Heads->get($id);
        if ($this->Heads->delete($head)) {
            $result = ['result'=>'success','message'=>'The head has been deleted.'];
        } else {
            $result = ['result'=>'error','message'=>'The head could not be deleted. Please try again.'];
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
    }
}
