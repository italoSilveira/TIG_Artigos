<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Flash',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'articles', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                      'username' => 'email'
                    )
                )
            )
        ),
		'Session',
        'GoogleAPI.GoogleAPI' => array(
			'Service' => array('Youtube')
		),
    );

    public function beforeFilter(){
		parent::beforeFilter();
        $file = new File(WWW_ROOT.'oauth-credentials.json');
        $json = $file->read(true, 'r');
        $this->GoogleAPI->googleClient->setAuthConfig($json);
        $this->GoogleAPI->googleClient->setRedirectUri(Router::url(array('controller'=>'users', 'action'=>'response'), true));
        $allowed = array('logout', 'login', 'add', 'response');
        if(!(
            ($this->params['controller'] == 'users') && in_array($this->params['action'], $allowed)
        )){
            if(!$this->Session->check('Auth.User.youtube_token')){
                $this->redirect($this->Auth->logout());
            }
        }
	}
}
