<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $order = $this->Orders->newEmptyEntity();

        $offices = $this->Orders->Offices->find('list', ['limit' => 200])->all();
        $suppliers = $this->Orders->Suppliers->find('list', ['limit' => 200])->all();
        $this->set(compact('order', 'offices', 'suppliers'));
    }

    public function getOrders()
    {
        $orders = $this->Orders->find('all',['contain'=>['Offices', 'Suppliers']]);
        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['data'=>$orders]));
    }

    public function getRequests()
    {
        $this->loadModel('Requests');
        $requests = $this->Requests->find()->contain(['Offices']);
        return $this->response->withType('application/json')
        ->withStringBody(json_encode(['data'=>$requests]));
    }

    public function printOrder($id=null)
    {
       $this->viewBuilder()->setLayout('pdf');
        $order = $this->Orders->get($id, [
            'contain' => ['Orderdetails.Items.Units','Offices', 'Suppliers'],
        ]);

        $this->set(compact( 'order'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Offices', 'Suppliers', 'Requests'],
        ]);

        $this->set(compact('order'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $order = $this->Orders->patchEntity($order,$data ,['associated'=>['Orderdetails']]);
            $order->status=0;
            if ($this->Orders->save($order)) {
                $result = ['result'=>'success','message'=>'The order has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The order could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        $offices = $this->Orders->Offices->find('list', ['limit' => 200])->all();
        $suppliers = $this->Orders->Suppliers->find('list', ['limit' => 200])->all();
        $requests = $this->Orders->Requests->find('list', ['limit' => 200])->all();
        $this->set(compact('order', 'offices', 'suppliers', 'requests'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Orderdetails.Items.Units'],
        ]);
        if ($this->order->is(['patch', 'post', 'put'])) {
            $data = $this->order->getData();
            $order = $this->Orders->patchEntity($order, $data ,['associated'=>['Orderdetails']]);
            if($order->budget==2 || $order->eo==2 || $order->po==2){
                $order->status=2;
            }else{
                if($order->budget==1 && $order->eo==1 && $order->po==1){
                    $order->status=1;
                }else{
                    $order->status=0;
                }
            }
            if ($this->Orders->save($order)) {
                $result = ['result'=>'success','message'=>'The order has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The order could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        $offices = $this->Orders->Offices->find('list', ['limit' => 200])->all();
        $this->set(compact('order', 'offices'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $result = ['result'=>'success','message'=>'The order has been deleted.'];
        }else{
            $result = ['result'=>'error','message'=>'The order could not be deleted. Please, try again.'];
        }
        return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
    }
}
