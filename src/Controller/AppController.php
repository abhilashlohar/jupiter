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
use Cake\Mailer\Email;
use Muffin\Footprint\Auth\FootprintAwareTrait;

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

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
       /*  $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => ['userModel' => $this->_userModel, 'fields' => ['username' => 'username'],'scope' => ['is_deleted' => false]]],
            'loginAction' => ['controller' => 'Users', 'action' => 'login'],
            'loginRedirect' => ['controller' => 'Dashboards', 'action' => 'index'],
            'unauthorizedRedirect' => $this->referer()
        ]); */
         $this->loadComponent('Auth', [
		 'authenticate' => [
                'Form' => [
				'fields' => [
                        'usernames' => 'usernames',
                        'password' => 'password'
                    ],
                      'userModel' => 'Users'
                ]
            ],
			'loginAction' => ['controller' => 'Users', 'action' => 'login'],
            'loginRedirect' => ['controller' => 'Dashboards', 'action' => 'index'],
			'unauthorizedRedirect' => $this->referer(),
        ]);
        if($this->request->getParam('prefix') == 'admin')
        {
			
            if(!$this->request->is('ajax'))
            {
                //$this->viewBuilder()->layout('admin');
                $this->viewBuilder()->setLayout('default'); 
                //$this->ViewBuilder::setLayout('admin')
            }
            
            $this->Auth->setConfig([
                'storage' => ['className' => 'Session', 'key' => 'Auth.Admin'
            ]]);
			
			/*  Email::configTransport('gmail',[
                'className' => 'Smtp',
                'host' => 'smtp.gmail.com',
                'port' => 587,
                'tls' => true,
                'username' => 'manoj@ifwworld.com',
                'password' => 'admin@@1',
				'context' => [
					'ssl' => [
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					]
				]
            ]); */
        }
		else
        {
             $this->Auth->config([
                'loginAction' => ['controller' => 'Users', 'action' => 'register'],
                'loginRedirect' => ['controller' => 'Users', 'action' => 'view'],
            ]);
		}
		$this->userAuth = $this->Auth->user();
        $this->userId = $this->Auth->user('id');
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
	
	public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        
        //$userAuth = $this->userAuth;
        //$coreVariable = $this->coreVariable;
        
        
        
        
        $this->set(compact('coreVariable', 'userAuth'));
       
    }
	protected function _getRandomString($length = 10, $validCharacters = null)
    {
        if($validCharacters == '')
        {
            $validCharacters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
        }
        
        $validCharactersCount = strlen($validCharacters);
        
        $string = '';
        for($i=0; $i<$length; $i++)
        {
            $string .= $validCharacters[mt_rand(0, $validCharactersCount-1)];
        }
        
        return $string;
    }
}
