<?php

use Phalcon\Http\Request;
use Phalcon\Mvc\Controller;
use Phalcon\Security;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Alnum;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
class SignupController extends Controller
{
    public function indexAction()
    {

    }

    public function registerAction()
    {
        $name    = $this->request->getPost('name', 'string');
        $password = $this->request->getPost('password', 'string');
        $mail     = $this->request->getPost('email','string');
        $validation = new Validation();
        $validation->add(
            'name',
            new PresenceOf(
                [
                    'message' => 'The name is required',
                ]
            )
        );
        
        $validation->add(
            'name',
            new PresenceOf(
                [
                    'message' => 'The e-mail is required',
                ]
                ),
                new Alnum(
                [
                    "message" => ":field must contain only alphanumeric characters",
                ]
            )
            );
        $validation->add(
            'password',
            new PresenceOf(
                [
                    'message' => 'The password is required',
                ]
            )
        );
        
        $validation->add(
            'email',
            new Email(
                [
                    'message' => 'The e-mail is not valid',
                ]
            )
        );
        
        $messages = $validation->validate($_POST);
        if (count($messages)) {
           
            foreach ($messages as $message) {
                echo $message, '<br>';
            }
        } else {

        
        $user = new Users();
        $user->name = $name;
        $user->email = $mail;
        $user->password= $this->security->hash($password);
        //assign value from the form to $user
         

         // Store and check for errors
         $success = $user->save();

         // passing the result to the view
         $this->view->success = $success;
         
         if ($success) {
             $message = "Thanks for registering!";
         } else {
             $message = "Sorry, the following problems were generated:<br>"
                      . implode('<br>', $user->getMessages());
         }
 
         // passing a message to the view
         
        }
    $this->view->message = $message;
    } // registerAction
} // class signupController