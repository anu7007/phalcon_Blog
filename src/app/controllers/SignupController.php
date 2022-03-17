<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{

    public function IndexAction()
    {
    }

    public function registerAction()
    {
        $user = new Users();
        
        $this->view->users = Users::find();
        $user->assign(
            $postdata=$this->request->getPost(),
            [
                'full_name',
                'username',
                'email',
                'password',
                'confirm_password',
                
            ]
        );
        $user->role='user';
        $user->status='pending';
        // $emailExists = $this->view->users = Users::find($postdata['email']);
        if($postdata['password']!=$postdata['confirm_password'])
        {
            $this->view->passwordError = "Passwords don't match";
        }
        // if($emailExists['email'])
        // {
        //     $this->view->emailExists = "Email already exists";
        // }
       
        else{
            $success = $user->save();
            $this->view->success = $success;
        }
        if ($success) {
            $this->view->message = "Register succesfully";
        } else {
            $this->view->message = "Not Register succesfully due to following reason: <br>" . implode("<br>", $user->getMessages());
        }
    }
    public function testAction()
    {
        echo "Test action";
    }
}
