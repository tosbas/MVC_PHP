<?php

use App\Controller;

class Main extends Controller
{

    /**
     * @var User
     */
    public $User;

    public function main()
    {

        $this->loadModel('User');
        $users = $this->User->getAll();

        $this->render('index', 'Accueil', compact('users'));
    }
}
