<?php

use Phalcon\Mvc\Controller;
use Phalcon\Security;
use Phalcon\Mvc\Model\Resultset;

class NftcollectionController extends Controller
{
    
   
    public function indexAction()
    {
        
       try{
        $collectionnft=Collectionnft::find();
        $collectionnft->setHydrateMode(
            Resultset::HYDRATE_ARRAYS
        );
        $this->view->NftCollection= $collectionnft;
        } //try
        catch (\Exception $e) 
        {
            echo 'Exception: ', $e->getMessage(); 

        }
    } // indexAction

    public function showAction($name)
    {
      
       try{
        $collectionnft=Collectionnft::findByName($name);
        $collectionnft->setHydrateMode(
            Resultset::HYDRATE_ARRAYS
        );
        $this->view->NftCollection= $collectionnft;
        } //try
        catch (\Exception $e) 
        {
            echo 'Exception: ', $e->getMessage();

        }
        //ici on injecte metamask en test
        
        
        $this->view->message=$name;

    }

}
