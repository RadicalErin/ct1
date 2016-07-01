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
        $number = rand(0, 100);
        return new Response("test");
    }
}
