<?php
use Phalcon\Http\Request;
use Phalcon\Mvc\Controller;
use Phalcon\Security;
use Phalcon\Session\Manager;


class SessionController extends Controller
{
    public function indexAction()
    {
      
    }

    public function loginAction()
    {
      try {  
        $login    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        
        $user = Users::findFirst(
            [
                'conditions' => 'email = :email:',
                'bind'       => [
                    'email' => $login,
                ],
            ]
        );
        
        
        if (false !== $user) {
            
            $check = $this->security->checkHash($password, $user->password);
           
            if (true === $check) {
                // OK
               
                
                $this->session->set('is_logged', 'true');
                $this->session->set('user', $user);
                $this->view->success=true;
                $message = "ok pour le login";

            }
            else {
                $this->session->set('is_logged', 'false');
                $this->view->success=false;
                 $message = "not ok pour le login";
            }


    }
$this->view->message = $message;
}// try
 catch (AuthException $e) {
  $message=$this->flash->error($e->getMessage());
}


} // fin loginAction

//logoutAction
    public function logoutAction()
    {
        $this->session->set('is_logged', 'false');
    } // logout
} // SessionController