<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Plandetails Controller
 *
 * @property \App\Model\Table\PlandetailsTable $Plandetails
 * @method \App\Model\Entity\Plandetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlandetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
    }

    public function getItem($id=null)
    {
        $this->loadModel('Items');
        $item = $this->Items->get($id);
        return $this->response->withType('application/json')
            ->withStringBody(json_encode($item));
    }

    public function addUpdate()
    {
        $this->loadModel('Plandetails');
        $plan = $this->Plandetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $qty = $this->Plandetails->setQty($data);
            $data['qty'] = $qty;
            if(!empty($data['id'])){
                $plan = $this->Plandetails->get($data['id']);
            }
            $plan = $this->Plandetails->patchEntity($plan, $data);
            if ($this->Plandetails->save($plan)) {
                $result = ['result'=>'success','message'=>'The ppmp has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The ppmp could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }

    }

    /**
     * View method
     *
     * @param string|null $id Plandetail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Plandetails');
        $plan = $this->Plandetails->newEmptyEntity();
        $this->loadModel('Categories');
        $this->loadModel('Items');
        $plan_id=$id;
        $categories = $this->Categories->find();
        $plandetails = $this->Plandetails->find()->contain('Items.Units','Methods');
        $planitems = $this->Plandetails->getDetails($plandetails,$categories);
        $methods = $this->Plandetails->Methods->find('list', ['limit' => 200])->all();
        $this->set(compact('planitems','plan', 'methods','categories','plan_id'));
    }

    public function printPlan($id = null)
    {
        $this->viewBuilder()->setLayout('pdf');
        $this->loadModel('Heads');
        $this->loadModel('Plans');
        $this->loadModel('Plandetails');
        $plan = $this->Plans->get($id);
        $this->loadModel('Categories');
        $this->loadModel('Items');
        $plan_id=$id;
        $coordinator = $this->Heads->find()->where(['position'=>'Campus Coordinator'])->first();
        $executive = $this->Heads->find()->where(['position'=>'Executive Officer'])->first();
        $categories = $this->Categories->find();
        $plandetails = $this->Plandetails->find()->contain('Items.Units','Methods');
        $planitems = $this->Plandetails->getDetails($plandetails,$categories);
        $methods = $this->Plandetails->Methods->find('list', ['limit' => 200])->all();
        $this->set(compact('planitems','plan', 'methods','categories','plan_id','coordinator','executive'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Plandetails');
        $this->loadModel('Items');
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $items = $this->Items->find()->all();
            $data = $this->Plandetails->setDetails($data,$items);
            $plan= $this->Plandetails->newEntities($data);

            if ($this->Plandetails->saveMany($plan)) {
                $result = ['result'=>'success','message'=>'The items has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The items could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        $this->set(compact('pPMPDetail'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Plandetail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Plandetails');
        $plan = $this->Plandetails->get($id, [
            'contain' => ['Items.Units','Methods'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plan = $this->Plandetails->patchEntity($plan, $this->request->getData());
            if ($this->Plandetails->save($plan)) {
                $result = ['result'=>'success','message'=>'The ppmp has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The ppmp could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        return $this->response->withType('application/json')
            ->withStringBody(json_encode($plan));
    }

    /**
     * Delete method
     *
     * @param string|null $id Plandetail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->loadModel('Plandetails');
        $this->request->allowMethod(['post', 'delete']);
        $pPMPDetail = $this->Plandetails->get($id);
        if ($this->Plandetails->delete($pPMPDetail)) {
            $result = ['result'=>'success','message'=>'The item has been saved.'];
        }else{
            $result = ['result'=>'error','message'=>'The item could not be saved. Please, try again.'];
        }
        return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
    }
}
