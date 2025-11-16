<?php

use App\Controller;

class Main extends Controller
{
    public function main()
    {

        $this->loadModel('User');
        $this->render('index', 'Accueil', []);
    }
}
