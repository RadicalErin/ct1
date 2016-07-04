<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CodeTestController extends Controller
{
    /**
     * @Route("/test")
     */
    public function showAction(){
        return $this->render("@App/index.html.twig");
    }
}
