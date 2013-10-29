<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    function _flash($message,$type='message') {
        $messages = (array)$this->Session->read('Message.multiFlash');
        $messages[] = array(
            'message'=>$message,
            'layout'=>'default',
	    'element'=> 'default',
	    'params'=>array('class'=>$type),
        );
        $this->Session->write('Message.multiFlash', $messages);
    }
    
    public function beforeFilter() {
        //$this->Auth->allowedActions = array('UserType'); //Allows access to UserType controller without logging in
        //$this->allow('logout');
    }
    
    public function beforeRender() {
        if($this->Auth->loggedIn()) {
            $this->viewClass = 'Theme'; //Activates use of themes
            $themes = array(1 => 'Overseer',2 => 'Registration',3 => 'Registration',4 => 'LRC',5 => 'Cashier');
            $this->theme = $themes[$this->Auth->user('UserType.account_type_id')];
            if($this->Auth->user('UserType.account_type_id') == 4) {
                App::import('Controller','Attendees');
                $Attendees = new AttendeesController;
                $Attendees->constructClasses();
                if($Attendees->_requirementCheck() && $this->request['controller'] == 'pages' && $this->request['pass'][0] == 'home') $this->_flash(__('Multiple errors found for saved attendees. Please correct ASAP. Incomplete registrations may be denied or late fees assessed.',true),'error');
            }
            $this->loadModel('Conference');
            $conferences = $this->Conference->find('list');
            $selected_conference = $this->Session->read('Conference.selected');
            $link = 'http://wiki.college-conference.com/'.strtolower($this->theme).'/index.php?title='.ucwords($this->request->params['controller']).':'.ucwords($this->request->params['action']);
            $user = $this->Auth->user();
            $this->set(compact('user','link','conferences','selected_conference'));
        }
    }
    
    public $components = array(
        'DebugKit.Toolbar',
        'Acl',
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            //'authorize' => array('Actions' => array('actionPath' => 'controllers'))
        ),
    );
	
    /**public function isAuthorized($user) {
	if (isset($user['id'])) {
            return true;
        }
        return false;
    }**/
//TODO consider using routing prefixes instead of themes for different roles

}
