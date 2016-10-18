<?php
/**
 * Users Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class AdminsController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    var $name = 'Admins';
/**
 * Components
 *
 * @var array
 * @access public
 */
    var $components = array(
        'Email',
    );
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
    var $uses = array('Admin');
	
    function beforeFilter() {
        parent::beforeFilter();
    }


    function control_add() {
        if (!empty($this->data)) {
        	$data = $this->data;
        	$data['Admin']['password']=md5($data['Admin']['password-sincodificar']);
            $this->Admin->create();
            if ($this->Admin->save($data)) {
                $this->Session->setFlash(__('Usuario creado.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El usuario no fue creado. Intente nuevamente.', true));
                unset($this->data['User']['password']);
            }
        } 
        
        $roles = $this->Admin->comboRoles();
        $this->set(compact('roles'));
    }

    function control_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Usuario invalido', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
        	$data = $this->data;
            if(!empty($data['Admin']['password-sincodificar'])){
            		$data['Admin']['password']=md5($data['Admin']['password-sincodificar']);
											}else{
												$data['Admin']['password']=$this->data['Admin']['password_anterior'];
											}
											$this->Admin->id=$id;
											if ($this->Admin->save($data)) {
                $this->Session->setFlash(__('Usuario guardado', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El usuario no pudo ser guardado. Intente nuevamente..', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Admin->read(null, $id);
        }
        $roles = $this->Admin->comboRoles();
        $this->set(compact('roles'));
    }


    function control_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Usuario invalido', true));
            $this->redirect(array('action' => 'index'));
        }
/*        if (!isset($this->params['named']['token']) || ($this->params['named']['token'] != $this->params['_Token']['key'])) {
            $blackHoleCallback = $this->Security->blackHoleCallback;
            $this->$blackHoleCallback();
        }*/
        
        if ($this->Admin->delete($id)) {
            $this->Session->setFlash(__('Usuario borrado', true));
            $this->redirect(array('action' => 'index'));
        }
    }
/*
    function control_login() {
        $this->set('title_for_layout', __('Admin Login', true));
        $this->layout = "admin_login";
    }
*/

    function forgot() {
        $this->set('title_for_layout', __('Forgot Password', true));

        if (!empty($this->data) && isset($this->data['User']['username'])) {
            $user = $this->User->findByUsername($this->data['User']['username']);
            if (!isset($user['User']['id'])) {
                $this->Session->setFlash(__('Invalid username.', true));
                $this->redirect(array('action' => 'login'));
            }

            $this->User->id = $user['User']['id'];
            $activationKey = md5(uniqid());
            $this->User->saveField('activation_key', $activationKey);
            $this->set(compact('user', 'activationKey'));

            $this->Email->from = Configure::read('Site.title') . ' '
                    . '<croogo@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])).'>';
            $this->Email->to = $user['User']['email'];
            $this->Email->subject = '[' . Configure::read('Site.title') . '] ' . __('Reset Password', true);
            $this->Email->template = 'forgot_password';
            if ($this->Email->send()) {
                $this->Session->setFlash(__('An email has been sent with instructions for resetting your password.', true));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('An error occurred. Please try again.', true));
            }
        }
    }

    function reset($username = null, $key = null) {
        $this->set('title_for_layout', __('Reset Password', true));

        if ($username == null || $key == null) {
            $this->Session->setFlash(__('An error occurred.', true));
            $this->redirect(array('action' => 'login'));
        }

        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.username' => $username,
                'User.activation_key' => $key,
            ),
        ));
        if (!isset($user['User']['id'])) {
            $this->Session->setFlash(__('An error occurred.', true));
            $this->redirect(array('action' => 'login'));
        }

        if (!empty($this->data) && isset($this->data['User']['password'])) {
            $this->User->id = $user['User']['id'];
            $user['User']['password'] = Security::hash($this->data['User']['password'], null, true);
            $user['User']['activation_key'] = md5(uniqid());
            if ($this->User->save($user['User'])) {
                $this->Session->setFlash(__('Your password has been reset successfully.', true));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('An error occurred. Please try again.', true));
            }
        }

        $this->set(compact('user', 'username', 'key'));
    }

	function control_login()
    {

    
        $this->set('error', false);
        
    	if (!empty($this->data))
        {
        	$usr = $this->Admin->find('first', 
        					array('username' => $this->data['Admin']['username']) );
			if(!empty($usr['Admin']['password']) && 
					  $usr['Admin']['password'] == md5($this->data['Admin']['password']) )         	
            {
            	$this->_loginSession($usr['Admin']);
            	$this->redirect(array('controller'=>'contactos','action'=>'index'));
            }
            else
            {
        		$this->set('error', true);
        		$this->Session->setFlash(__('Usuario / Clave incorrecta', true));
            }
        }
        $this->set('title_for_layout', __('Ingreso de administrador', true));
        $this->layout = "admin_login";
                
    }

    
    function control_index() {
    	//$this->_checkAdmin();
    	
    	$this->set('title_for_layout', __('Usuarios', true));

        $this->Admin->recursive = 0;
        $this->set('users', $this->paginate());
    }


    function control_logout()
    {
		$this->_logoutSession();
        $this->redirect(array('controller'=>'admins', 'action'=>'login'));
    }
    
    function _loginSession( $usr ) {
    	$this->Admin->id = $usr['id'];
//    	$this->User->saveField('accessed',date('Y-m-d H:i:s'));
		$this->Session->write('Admin', $usr);
//		$this->Cookie->write('User',$usr);
	}


	function _logoutSession() {
        $this->Session->delete('Admin');
//		$this->Cookie->del('UsuarioInterno');
	}
}
?>