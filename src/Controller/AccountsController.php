<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Accounts Controller
 *
 * @property \App\Model\Table\AccountsTable $Accounts
 *
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $user_id = $this->Auth->user()->id;
        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => ['Accounts.user_id' => $user_id]
        ];
        $accounts = $this->paginate($this->Accounts);

        $this->set(compact('accounts'));
    }

    /**
     * View method
     *
     * @param string|null $id Account id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $account = $this->Accounts->get($id, [
            'contain' => ['Users', 'AccountsTransactions']
        ]);

        $this->set('account', $account);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $account = $this->Accounts->newEntity();
        $user_id = $this->Auth->user()->id;
        $token = $this->request->getParam('_csrfToken');
        if ($this->request->is('post')) {
            $imageFileName ='';
            if (!empty($this->request->data['idntity_file']['name'])) {
                $file = $this->request->data['idntity_file'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('.jpeg', 'jpg', 'png', 'pdf', 'docx', 'doc'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);
                $account_no = date('Y').sprintf("%04d", $user_id).time();
                if (in_array($ext, $arr_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . '/upload/' . $setNewFileName . '.' . $ext);
                    //prepare the filename for database entry 
                    $imageFileName = $setNewFileName . '.' . $ext;
                    $account = $this->Accounts->patchEntity($account, $this->request->getData());
                    if (!empty($this->request->data['idntity_file']['name'])) {
                        $account->idntity_file = $imageFileName;
                    }
                    $account->amount = $this->request->data['opening_amount'];
                    $account->account_no = $account_no;
                    if ($this->Accounts->save($account)) {
                        $this->Flash->success(__('New Account opened.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('The account could not be saved. Please, try again.'));
                    }
                } else {
                    $this->Flash->success(__('File format not supported.'));
                }
            } else {
                $this->Flash->error(__('Please upload your any ID card\'s softcopy.'));
            }
        }
        // $users = $this->Accounts->Users->find('list', ['limit' => 200]);
        $this->set(compact('account', 'user_id', 'token'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Account id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $account = $this->Accounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $account = $this->Accounts->patchEntity($account, $this->request->getData());
            if ($this->Accounts->save($account)) {
                $this->Flash->success(__('The account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The account could not be saved. Please, try again.'));
        }
        $users = $this->Accounts->Users->find('list', ['limit' => 200]);
        $this->set(compact('account', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Account id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $account = $this->Accounts->get($id);
        if ($this->Accounts->delete($account)) {
            $this->Flash->success(__('The account has been deleted.'));
        } else {
            $this->Flash->error(__('The account could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function dashboard(){
        $userobj = $this->Auth->user();
        $user_id = $this->Auth->user()->id;
        $token = $this->request->getParam('_csrfToken');
        $user = $userobj->toArray();
        $full_name = trim($user['first_name'] . ' ' . $user['last_name']);
        $accounts = $this->Accounts->find('list', [
            'keyField' => 'id',
            'valueField' => 'account_no'
        ])->where(['user_id' => $user_id]);
        $this->set(compact('full_name', 'accounts', 'user_id', 'token'));
    }

    public function checkBalance(){
        if ($this->request->is('post')) {
            // checkblnc
            $return_arr = array();
            if($this->request->data['account_id']){
                $blnc = $this->Accounts->findById($this->request->data['account_id'])->toArray();
                // print_r($blnc); die();
                $return_arr['status'] = 'success';
                $return_arr['msg'] = $blnc[0]['amount'];
            } else {
                $return_arr['status'] = 'error';
                $return_arr['msg'] = 'Select Account';
            }
            
        }
        echo json_encode($return_arr);
        die();
    }
}
