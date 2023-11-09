<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Units Controller
 *
 * @property \App\Model\Table\UnitsTable $Units
 * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UnitsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $unit = $this->Units->newEmptyEntity();
        $this->set(compact('unit'));
    }

    public function getUnits()
    {
        $unit= $this->Units->find();
        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['data'=>$unit]));
    }

    /**
     * View method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('unit'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $unit = $this->Units->newEmptyEntity();
        if ($this->request->is('post')) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $result = ['result'=>'success','message'=>'The unit has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The unit could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        $this->set(compact('unit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $result = ['result'=>'success','message'=>'The unit has been updated.'];
            } else {
                $result = ['result'=>'error','message'=>'The unit could not be updated. Please try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($unit));
    }

    /**
     * Delete method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $unit = $this->Units->get($id);
        if ($this->Units->delete($unit)) {
            $result = ['result'=>'success','message'=>'The unit has been deleted.'];
        } else {
            $result = ['result'=>'error','message'=>'The unit could not be deleted. Please try again.'];
        }
        return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
    }
}
