<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * AccountsTransactions Controller
 *
 * @property \App\Model\Table\AccountsTransactionsTable $AccountsTransactions
 *
 * @method \App\Model\Entity\AccountsTransaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountsTransactionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            // 'contain' => ['Accounts'],
            'limit' => 5
        ];
        $user_id = $this->Auth->user()->id;
        $query = $this->AccountsTransactions->find()
            ->select(['ac.account_no', 'tm.account_no', 'AccountsTransactions.transaction_type',
                'AccountsTransactions.amount', 'AccountsTransactions.invoice_no', 'AccountsTransactions.created'])
            ->join([
                'tm' => [
                    'table' => 'accounts',
                    'type' => 'left',
                    'conditions' => [
                        'tm.id' => new \Cake\Database\Expression\IdentifierExpression('AccountsTransactions.transfer_to')
                    ]
                ],
                'ac' => [
                    'table' => 'accounts',
                    'type' => 'left',
                    'conditions' => [
                        'ac.id' => new \Cake\Database\Expression\IdentifierExpression('AccountsTransactions.account_id')
                    ]
                ],
            ])
            ->where([
                'or' => [
                    'ac.user_id' => $user_id,
                    'tm.user_id' => $user_id
                ]
                
            ])
            ;
        // print_r($this->paginate($query)); die();
        $transaction_type = array(1 => 'Deposit', 2 => 'Fund Transfer');
        $accountsTransactions = $this->paginate($query);
        // print_r($accountsTransactions); die();
        
        $accounts = $this->AccountsTransactions->Accounts->find('list', [
            'keyField' => 'id',
            'valueField' => 'account_no'
        ])->where(['user_id' => $user_id]);
        $connection = ConnectionManager::get('default');
        // $inovice_list_arr = $connection->execute("SELECT atr.id, atr.invoice_no FROM accounts_transactions atr 
        //     left join accounts ac on (ac.id = atr.account_id and ac.deleted=0)
        //     where atr.deleted = 0 and ac.user_id=$user_id")->fetchAll('assoc');
        // $inovice_list = array();
        // foreach($inovice_list_arr as $val){
        //     $inovice_list[$val['id']] = $val['invoice_no'];
        // }
        $token = $this->request->getParam('_csrfToken');
        $this->set(compact('accountsTransactions', 'accounts', 'user_id', 'transaction_type', 'token'));
    }


    public function report(){
        if ($this->request->is('post')) {
            $account_id = $this->request->data['account_id'];
            $from_date = $this->request->data['from_date'] ? date('Y-m-d', strtotime($this->request->data['from_date'])) : '';
            $to_date = $this->request->data['to_date'] ? date('Y-m-d', strtotime($this->request->data['to_date'])) : '';
            $transaction_type = $this->request->data['transaction_type'];
            $conditions1 = array();
            if($account_id){
                $conditions1 = array(
                    'AccountsTransactions.account_id' => $account_id
                );
            }

            $conditions2 = array();
            if($from_date && $to_date){
                $conditions2 = array(
                    'DATE(AccountsTransactions.created) >=' => $from_date,
                    'DATE(AccountsTransactions.created) <=' => $to_date,
                );
            }
            $conditions3 = array();
            if($transaction_type){
                $conditions3 = array(
                    'AccountsTransactions.transaction_type' => $transaction_type
                );
            }

            // $this->paginate = [
            //     // 'contain' => ['Accounts'],
            //     'limit' => 5
            // ];
            $user_id = $this->Auth->user()->id;
            $query = $this->AccountsTransactions->find()
                ->select(['ac.account_no', 'tm.account_no', 'AccountsTransactions.transaction_type',
                    'AccountsTransactions.amount', 'AccountsTransactions.invoice_no', 'AccountsTransactions.created'])
                ->join([
                    'tm' => [
                        'table' => 'accounts',
                        'type' => 'left',
                        'conditions' => [
                            'tm.id' => new \Cake\Database\Expression\IdentifierExpression('AccountsTransactions.transfer_to')
                        ]
                    ],
                    'ac' => [
                        'table' => 'accounts',
                        'type' => 'left',
                        'conditions' => [
                            'ac.id' => new \Cake\Database\Expression\IdentifierExpression('AccountsTransactions.account_id')
                        ]
                    ],
                ])
                ->where([
                    'or' => [
                        'ac.user_id' => $user_id,
                        'tm.user_id' => $user_id
                    ],
                    $conditions1,
                    $conditions2,
                    $conditions3
                ])
                ;
            // print_r($query); die();
            // print_r($this->paginate($query)); die();
            $transaction_type = array(1 => 'Deposit', 2 => 'Fund Transfer');
            $accountsTransactions = $this->paginate($query);
        }
        $this->set(compact('accountsTransactions', 'transaction_type'));
    }

    /**
     * View method
     *
     * @param string|null $id Accounts Transaction id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accountsTransaction = $this->AccountsTransactions->get($id, [
            'contain' => ['Accounts']
        ]);

        $this->set('accountsTransaction', $accountsTransaction);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accountsTransaction = $this->AccountsTransactions->newEntity();
        $getInvoiceNo = $this->AccountsTransactions->find('all', array('order' => array('id' => 'DESC')))->toArray();
        // print_r($getInvoiceNo); die();
        if(empty($getInvoiceNo)){
            $invoice_no = date('Y') . '#' .sprintf("%06d", 1);
        } else {
            $expldData = explode('#', $getInvoiceNo[0]['invoice_no']);
            $invoice_sl = $expldData[1] + 1;
            $invoice_no = date('Y') . '#' .sprintf("%06d", $invoice_sl);
        }
        if ($this->request->is('post')) {
            if($this->request->data['account_id'] && $this->request->data['amount'] > 0.000000 && $this->request->data['transfer_to']){

                if($this->request->data['account_id'] == $this->request->data['transfer_to']){
                    $this->Flash->success(__('Same account deposit is not possible.'));
                    return $this->redirect(['action' => 'add']);
                }
                $getAccountDetails = $this->AccountsTransactions->Accounts->get($this->request->data['account_id']);
                $getAccountDetailsArr = $getAccountDetails->toArray();
                if($getAccountDetailsArr['amount'] < $this->request->data['amount']){
                    $this->Flash->success(__('Insufficient Balance.'));
                    return $this->redirect(['action' => 'add']);
                }
                $accountsTransaction = $this->AccountsTransactions->patchEntity($accountsTransaction, $this->request->getData());
                if ($this->AccountsTransactions->save($accountsTransaction)) {
                    //withdraw
                    $getAccountDetailsArr['amount'] = $getAccountDetailsArr['amount'] - $this->request->data['amount'];
                    $getAccountDetails = $this->AccountsTransactions->Accounts->patchEntity($getAccountDetails, $getAccountDetailsArr);
                    $this->AccountsTransactions->Accounts->save($getAccountDetails);
                    //deposit
                    $getTransferAccountDetails = $this->AccountsTransactions->Accounts->get($this->request->data['transfer_to']);
                    $getTransferAccountDetailsArr = $getTransferAccountDetails->toArray();
                    $getTransferAccountDetailsArr['amount'] = $getTransferAccountDetailsArr['amount'] + $this->request->data['amount'];
                    $getTransferAccountDetails = $this->AccountsTransactions->Accounts->patchEntity($getTransferAccountDetails, $getTransferAccountDetailsArr);
                    $this->AccountsTransactions->Accounts->save($getTransferAccountDetails);
                    
                    $this->Flash->success(__('The accounts transaction has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The accounts transaction could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('Please select Account no, transaction type and provide amount.'));
            }
        }
        $user_id = $this->Auth->user()->id;
        $accounts = $this->AccountsTransactions->Accounts->find('list', [
            'keyField' => 'id',
            'valueField' => 'account_no'
        ])->where(['user_id' => $user_id]);
        $transaction_type = array(1 => 'Deposit', 2 => 'Withdraw', 3 => 'Transfer');
        $this->set(compact('user_id', 'accountsTransaction', 'accounts', 'transaction_type', 'invoice_no'));
    }

    //fund transfer
    public function fundTransfer(){
        $accountsTransaction = $this->AccountsTransactions->newEntity();
        $getInvoiceNo = $this->AccountsTransactions->find('all', array('order' => array('id' => 'DESC')))->toArray();
        // print_r($getInvoiceNo); die();
        if(empty($getInvoiceNo)){
            $invoice_no = date('Y') . '#' .sprintf("%06d", 1);
        } else {
            $expldData = explode('#', $getInvoiceNo[0]['invoice_no']);
            $invoice_sl = $expldData[1] + 1;
            $invoice_no = date('Y') . '#' .sprintf("%06d", $invoice_sl);
        }
        if ($this->request->is('post')) {
            if($this->request->data['account_id'] && $this->request->data['amount'] > 0.000000 && $this->request->data['fund_transfer_acc_no']){
                $fund_transfer_acc_no = $this->request->data['fund_transfer_acc_no'];
                $accExist = $this->AccountsTransactions->Accounts->findByAccountNo($fund_transfer_acc_no)->first();
                if(empty($accExist)){
                     $this->Flash->success(__('Please provide valid Account no.'));
                     return $this->redirect(['action' => 'fundTransfer']);
                } else {
                    $accExistArr = $accExist->toArray();
                }

                if($this->request->data['account_id'] == $accExistArr['id']){
                    $this->Flash->success(__('Same account transfer is not possible.'));
                    return $this->redirect(['action' => 'fundTransfer']);
                }
                
                $getAccountDetails = $this->AccountsTransactions->Accounts->get($this->request->data['account_id']);
                $getAccountDetailsArr = $getAccountDetails->toArray();
                if($getAccountDetailsArr['amount'] < $this->request->data['amount']){
                    $this->Flash->success(__('Insufficient Balance.'));
                    return $this->redirect(['action' => 'fundTransfer']);
                }
                $accountsTransaction = $this->AccountsTransactions->patchEntity($accountsTransaction, $this->request->getData());
                $accountsTransaction->transfer_to = $accExistArr['id'];
                if ($this->AccountsTransactions->save($accountsTransaction)) {
                    //withdraw
                    $getAccountDetailsArr['amount'] = $getAccountDetailsArr['amount'] - $this->request->data['amount'];
                    $getAccountDetails = $this->AccountsTransactions->Accounts->patchEntity($getAccountDetails, $getAccountDetailsArr);
                    $this->AccountsTransactions->Accounts->save($getAccountDetails);
                    //deposit
                    $getTransferAccountDetails = $this->AccountsTransactions->Accounts->get($accExistArr['id']);
                    $getTransferAccountDetailsArr = $getTransferAccountDetails->toArray();
                    $getTransferAccountDetailsArr['amount'] = $getTransferAccountDetailsArr['amount'] + $this->request->data['amount'];
                    $getTransferAccountDetails = $this->AccountsTransactions->Accounts->patchEntity($getTransferAccountDetails, $getTransferAccountDetailsArr);
                    $this->AccountsTransactions->Accounts->save($getTransferAccountDetails);
                    
                    $this->Flash->success(__('Fund transfer commpleted.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The accounts transaction could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('Please select Account no, transaction type and provide amount.'));
            }
        }
        $user_id = $this->Auth->user()->id;
        $accounts = $this->AccountsTransactions->Accounts->find('list', [
            'keyField' => 'id',
            'valueField' => 'account_no'
        ])->where(['user_id' => $user_id]);
        $transaction_type = array(1 => 'Deposit', 2 => 'Withdraw', 3 => 'Transfer');
        $this->set(compact('user_id', 'accountsTransaction', 'accounts', 'transaction_type', 'invoice_no'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Accounts Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accountsTransaction = $this->AccountsTransactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accountsTransaction = $this->AccountsTransactions->patchEntity($accountsTransaction, $this->request->getData());
            if ($this->AccountsTransactions->save($accountsTransaction)) {
                $this->Flash->success(__('The accounts transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accounts transaction could not be saved. Please, try again.'));
        }
        $accounts = $this->AccountsTransactions->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('accountsTransaction', 'accounts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Accounts Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accountsTransaction = $this->AccountsTransactions->get($id);
        if ($this->AccountsTransactions->delete($accountsTransaction)) {
            $this->Flash->success(__('The accounts transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The accounts transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
