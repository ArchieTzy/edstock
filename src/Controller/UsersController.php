<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    // function beforeFilter(\Cake\Event\EventInterface $event)
    // {
    //     parent::beforeFilter($event);
    //     $this->Auth->allow(['login']);
    // }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->Users->newEmptyEntity();

        $departments = $this->Users->Departments->find('list')->all();

        $this->set(compact('user', 'departments'));
    }

    // public function login()
    // {
    //     $this->viewBuilder()->setLayout('login');
    //     if ($this->request->is('post')) {
    //         $user = $this->Auth->identify();
    //         if($user) {
    //             $this->Auth->setUser($user);
    //             return $this->redirect($this->Auth->redirectUrl());
    //         }
    //         $this->Flash->error(__('Invalid username or password, try again'));
    //     }
    // }

    // public function logout()
    // {
    //     return $this->redirect($this->Auth->logout());

    //     if ($this->getRequest()->getData('data-widget') === 'logout') {
    //     return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    //     }
    // }

    public function getUsers()
    {
        $users = $this->Users->find()
        ->contain(['Departments'])
        ->toArray();

        return $this->response->withType('application/json')
        ->withStringBody(json_encode(['data'=>$users])); 
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Departments'],
        ]);

        return $this->response->withType('application/json')
        ->withStringBody(json_encode($user));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $result = ['result'=>'success','message'=>'The user has been saved.'];
            }else{
                $result = ['result'=>'error','message'=>'The user could not be saved. Please, try again.'];
            }
            return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
        }
        $department = $this->Users->Departments->find('list', ['limit' => 200])->toArray();
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $result = ['result'=>'success','message'=>'The user has been updated.'];
            } else {
                $result = ['result'=>'error','message'=>'The user could not be updated. Please try again.'];
            }
            return $this->response->withType('application/json')
            ->withStringBody(json_encode($result));
        }
        return $this->response->withType('application/json')
        ->withStringBody(json_encode($user));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $result = ['result'=>'success','message'=>'The user has been deleted.'];
        } else {
            $result = ['result'=>'error','message'=>'The user could not be deleted. Please try again.'];
        }
        return $this->response->withType('application/json')
        ->withStringBody(json_encode($result));
    }
}
