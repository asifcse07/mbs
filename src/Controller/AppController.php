<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'loginPreview',
            ],
            // 'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password', 'passcode' => 'passcode']
                ]
            ],
            'storage' => 'Session'
        ]);

        // $this->loadComponent('Auth', [
        //     'authorize' => 'Controller',
        //     'authenticate' => [
        //         'Form' => [
        //             'fields' => [
        //                 'username' => 'email',
        //                 'password' => 'password',
        //                 'passcode' => 'passcode'
        //             ]
        //         ]
        //     ],
        //     'loginAction' => [
        //         'controller' => 'Users',
        //         'action' => 'loginPreview'
        //     ],
        //     'unauthorizedRedirect' =>
        //         [
        //         'controller' => 'Users',
        //         'action' => 'loginPreview'
        //     ],
        // ]);
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    public function isAuthorized($user = null){
        // Default deny
        return false;
    }

    public function beforeFilter(Event $event){
         $this->Auth->allow(array('registration', 'saveRegister', 'login'));
        if (in_array($this->request->param('action'), ['registration', 'saveRegister', 'login','add', 'fundTransfer', 'report', 'checkBalance'])){
            $this->getEventManager()->off($this->Csrf);
        }
    }

    public function beforeSave($event, $entity, $options) {
        $entity->dateField = date('Y-m-d', strtotime($entity->dateField));
    }
}
