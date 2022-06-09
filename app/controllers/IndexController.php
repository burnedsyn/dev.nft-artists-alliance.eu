<?php

use Phalcon\Mvc\Controller;
use Phalcon\Assets\Manager;  

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->assets->addJs('js/particles.min.js');
        $this->assets->addJs('js/app.js');
        $this->assets->addJs('https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js');
        $this->assets->addJs('js/block.js');
    }
}