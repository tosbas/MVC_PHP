<?php

use App\Controller;

class MainController extends Controller
{
    public function main()
    {
        $this->render('Main', 'Accueil', []);
    }
}
