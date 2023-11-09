<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Methods Controller
 *
 * @property \App\Model\Table\MethodsTable $Methods
 * @method \App\Model\Entity\Method[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MethodsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $method = $this->Methods->newEmptyEntity();
        $this->set(compact('method'));
    }

    public function getMethods()
    {
        $method= $this->Methods->find();
        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['data'=>$method]));
    }

    /**
     * View method
     *
     * @param string|null $id Method id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $method = $this->Methods->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('method'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $method = $this->Methods->newEmptyEntity();
        if ($this->request->is('post')) {
            $method = $this->Methods->patchEntity($method, $this->request->getData());
            if ($this->Methods->save($method)) {
                $result = ['result'=>'success','message'=>'The method has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The method could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        $this->set(compact('method'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Method id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $method = $this->Methods->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $method = $this->Methods->patchEntity($method, $this->request->getData());
            if ($this->Methods->save($method)) {
                $result = ['result'=>'success','message'=>'The method has been updated.'];
            } else {
                $result = ['result'=>'error','message'=>'The method could not be updated. Please try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($method));
    }

    /**
     * Delete method
     *
     * @param string|null $id Method id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $method = $this->Methods->get($id);
        if ($this->Methods->delete($method)) {
            $result = ['result'=>'success','message'=>'The method has been deleted.'];
        } else {
            $result = ['result'=>'error','message'=>'The method could not be deleted. Please try again.'];
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
    }
}
