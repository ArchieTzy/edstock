<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Offices Controller
 *
 * @property \App\Model\Table\OfficesTable $Offices
 * @method \App\Model\Entity\Office[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OfficesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $office = $this->Offices->newEmptyEntity();
        $this->set(compact('office'));
    }

    public function getOffices()
    {
        $office= $this->Offices->find();
        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['data'=>$office]));
    }

    /**
     * View method
     *
     * @param string|null $id Office id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $office = $this->Offices->get($id, [
            'contain' => ['Users'],
        ]);

        return $this->response->withType('application/json')
                ->withStringBody(json_encode($office));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $office = $this->Offices->newEmptyEntity();
        if ($this->request->is('post')) {
            $office = $this->Offices->patchEntity($office, $this->request->getData());
            if ($this->Offices->save($office)) {
                $result = ['result'=>'success','message'=>'The office has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The office could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        $this->set(compact('office'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Office id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $office = $this->Offices->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $office = $this->Offices->patchEntity($office, $this->request->getData());
            if ($this->Offices->save($office)) {
                $result = ['result'=>'success','message'=>'The office has been updated.'];
            } else {
                $result = ['result'=>'error','message'=>'The office could not be updated. Please try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($office));
    }

    /**
     * Delete method
     *
     * @param string|null $id Office id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $office = $this->Offices->get($id);
        if ($this->Offices->delete($office)) {
            $result = ['result'=>'success','message'=>'The office has been deleted.'];
        } else {
            $result = ['result'=>'error','message'=>'The office could not be deleted. Please try again.'];
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
    }
}
