<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequestsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $request = $this->Requests->newEmptyEntity();

        $this->set(compact('request'));
    }

    public function getRequests()
    {
        $requests = $this->Requests->find('all',['contain'=>['Offices']]);
        return $this->response->withType('application/json')
        ->withStringBody(json_encode(['data'=>$requests]));
    }

    public function getItems()
    {
        $this->loadModel('Items');
        $items = $this->Items->find()->contain(['Categories', 'Units'])->where(['cost IS NOT NULL']);
        return $this->response->withType('application/json')
        ->withStringBody(json_encode(['data'=>$items]));
    }

    public function getItem($id=null)
    {
        $this->loadModel('Items');
        $item = $this->Items->get($id,['contain'=>['Units']]);
        return $this->response->withType('application/json')
        ->withStringBody(json_encode($item));
    }

    public function printRequest($id=null)
    {
        $this->loadModel('Users');
        $this->viewBuilder()->setLayout('pdf');
        $coordinator = $this->Users->find()->where(['NOT'=>['position'=>'Executive Officer']])->first();
        $head = $this->Users->find()->where(['position'=>'Executive Officer'])->first();
        $request = $this->Requests->get($id, [
            'contain' => ['Requestdetails.Items.Units','Offices'],
        ]);
        $this->set(compact( 'request','head','coordinator'));
    }

    public function uploadFile($id=null)
    {
        $request = $this->Requests->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $path = 'uploads/requests';
            $file = $data['document'];
            $mimes = ['application/pdf'];
            if(!in_array($file['type'],$mimes)){
                $result=['result'=>'error','message'=>'Wrong file type'];
                return $this->response->withType('application/json')
                    ->withStringBody(json_encode($result));
            }
            if($file['error']==0){
                $data['document'] = $file['name'];
            }
            $request = $this->Requests->patchEntity($request, $data);
            if ($this->Requests->save($request)) {
                move_uploaded_file($file['tmp_name'], WWW_ROOT.$path.DS.$file['name']);
                $result = ['result'=>'success','message'=>'The document has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The document could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
    }
    public function viewFile($id=null)
    {
        $request = $this->Requests->get($id);

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($request));
    }

    public function restore($id=null)
    {
        $this->loadModel('Requestdetails');
        $request = $this->Requests->get($id,['withDeleted']);
        $details = $this->Requestdetails->find('all', ['withDeleted'])->where(['request_id'=>$id]);
        $request->deleted = null;
        if ($this->Requests->save($request)) {
            foreach ($details as $detail){
                $detail->deleted = null;
                $this->Requestdetails->save($detail);
            }
            $result = ['result'=>'success','message'=>'The request has been restored.'];
        }else{
            $result = ['result'=>'error','message'=>'The request could not be restored. Please, try again.'];
        }
        return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $request = $this->Requests->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['status']='0';
            $request = $this->Requests->patchEntity($request, $data ,['associated'=>['Requestdetails']]);
            if ($this->Requests->save($request)) {
                $result = ['result'=>'success','message'=>'The request has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The request could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
                ->withStringBody(json_encode($result));
        }
        $offices = $this->Requests->Offices->find('list', ['limit' => 200])->all();
        $this->set(compact('request', 'offices'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => ['Requestdetails.Items.Units'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $request = $this->Requests->patchEntity($request, $data, ['associated' => ['Requestdetails']]);

            if ($data['budget'] == 2 || $data['eo'] == 2 || $data['po'] == 2) {
            $request->status = 2; // Disapproved
        } else {
            if ($data['budget'] == 1 && $data['eo'] == 1 && $data['po'] == 1) {
                $request->status = 1; // Approved
            } else {
                $request->status = 0; // Default or other status (Pending)
            }
        }

        if ($this->Requests->save($request)) {
            $result = ['result' => 'success', 'message' => 'The request has been saved.'];
        } else {
            $result = ['result' => 'error', 'message' => 'The request could not be saved. Please try again.'];
        }

        return $this->response->withType('application/json')->withStringBody(json_encode($result));
    }

    $offices = $this->Requests->Offices->find('list', ['limit' => 200])->all();
    $this->set(compact('request', 'offices'));
}


    public function deleteFile($id = null)
    {
        $request = $this->Requests->get($id);
        $path = 'uploads/requests';
        if(file_exists(WWW_ROOT.$path.DS.$request->document)){
            unlink(WWW_ROOT.$path.DS.$request->document);
        }
        $request->document = null;
        if ($this->Requests->save($request)) {
            $result = ['result'=>'success','message'=>'The document has been deleted.'];
        }else{
            $result = ['result'=>'error','message'=>'The document could not be deleted. Please, try again.'];
        }
        return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
    }

    /**
     * Delete method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        if ($this->Requests->delete($request)) {
            $result = ['result'=>'success','message'=>'The request has been deleted.'];
        }else{
            $result = ['result'=>'error','message'=>'The request could not be deleted. Please, try again.'];
        }
        return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
    }
}
