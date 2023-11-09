<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fclusters Controller
 *
 * @property \App\Model\Table\FclustersTable $Fclusters
 * @method \App\Model\Entity\Fcluster[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FclustersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $fcluster = $this->Fclusters->newEmptyEntity();
        $this->set(compact('fcluster'));
    }

    public function getFclusters()
    {
        $fcluster= $this->Fclusters->find();
        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['data'=>$fcluster]));
    }

    /**
     * View method
     *
     * @param string|null $id Fcluster id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fcluster = $this->Fclusters->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('fcluster'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fcluster = $this->Fclusters->newEmptyEntity();
        if ($this->request->is('post')) {
            $fcluster = $this->Fclusters->patchEntity($fcluster, $this->request->getData());
            if ($this->Fclusters->save($fcluster)) {
                $result = ['result'=>'success','message'=>'The fund cluster has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The fund cluster could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        $this->set(compact('fcluster'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fcluster id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fcluster = $this->Fclusters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fcluster = $this->Fclusters->patchEntity($fcluster, $this->request->getData());
            if ($this->Fclusters->save($fcluster)) {
                $result = ['result'=>'success','message'=>'The Fund cluster has been updated.'];
            } else {
                $result = ['result'=>'error','message'=>'The Fund cluster could not be updated. Please try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($fcluster));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fcluster id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fcluster = $this->Fclusters->get($id);
        if ($this->Fclusters->delete($fcluster)) {
            $result = ['result'=>'success','message'=>'The fund cluster has been deleted.'];
        } else {
            $result = ['result'=>'error','message'=>'The fund cluster could not be deleted. Please try again.'];
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
    }
}
