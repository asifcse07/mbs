<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;
use Cake\Validation\Validation;
use Cake\Event\Event;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('registration', 'saveRegister');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Accounts']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function loginPreview(){
        if ($this->Auth->user()){
            return $this->redirect(['controller' => 'accounts', 'action' => 'dashboard']);
        } else {
            $this->viewBuilder()->layout(false);
            $token = $this->request->getParam('_csrfToken');
            $this->set(compact('token'));
        }
    }

    public function login(){
        $this->autoRender = false;
        if ($this->Auth->user()){
            return $this->redirect(['controller' => 'accounts', 'action' => 'dashboard']);
        } else {
            if ($this->request->is('post')) {
                $return_arr = array();
                $email = $this->request->getData('email');
                $passcode = $this->request->getData('passcode');
                $password = $this->request->getData('password');
                $user = $this->Users->findByEmailAndPasscode($email, $passcode)->first();
                 // print_r($password); die();
                if ($user && (new DefaultPasswordHasher())->check($password, $user->password)) {
                    $this->Auth->setUser($user);
                    $return_arr['status'] = 'success';
                    $return_arr['msg'] = 'Welcome';
                }else {
                    $return_arr['status'] = 'error';
                    $return_arr['msg'] = 'Wrong credential.';
                }
            }
            echo json_encode($return_arr);
            die();
        }
    }


    public function registration(){
        if ($this->Auth->user()){
            return $this->redirect(['controller' => 'accounts', 'action' => 'dashboard']);
        } else {
            $token = $this->request->getParam('_csrfToken');
            $this->viewBuilder()->layout(false);
            $this->set(compact('token'));
        }
    }

    public function saveRegister(){
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $return_arr = array();
            if($this->request->data['first_name'] && $this->request->data['email'] && $this->request->data['password'] && $this->request->data['passcode']){
                if(!filter_var($this->request->data['email'], FILTER_VALIDATE_EMAIL)){
                    $return_arr['status'] = 'error';
                    $return_arr['msg'] = 'Please provide valid email address.';
                } else {
                    $customerTable = TableRegistry::getTableLocator()->get('Users');
                    $customer = $customerTable->newEntity();
                    $customer->first_name = $this->request->data['first_name'];
                    $customer->last_name = $this->request->data['last_name'];
                    if($this->request->data['birthday']){
                        $time = date('Y-m-d', strtotime($this->request->data['birthday']));
                        $customer->dob = $time;
                    }
                    $customer->email = $this->request->data['email'];
                    $customer->passcode = $this->request->data('passcode');
                    $customer->gender = $this->request->data('gender');
                    $customer->deleted = 0;
                    $password = $this->request->data('password');
                    $customer->password = $password;
                    
                    if ($customerTable->save($customer)) {
                        $return_arr['status'] = 'success';
                        $return_arr['msg'] = 'User Created';
                    } else {
                        $return_arr['status'] = 'error';
                        $return_arr['msg'] = 'Email exists.';
                    }
                }
            } else {
                $return_arr['status'] = 'error';
                $return_arr['msg'] = 'Please fill First Name, Email, Password and Passcode field.';
            }
        }
        echo json_encode($return_arr);
        die();
    }


    public function logout()
    {
        $this->autoRender = false;
        return $this->redirect($this->Auth->logout());
    }
}
