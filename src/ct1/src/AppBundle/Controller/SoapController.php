<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/soap")
 */
class SoapController extends Controller
{
    /**
     * @route(
     *     "/",
     *     name="soap_index"
     * )
     */
    public function indexAction()
    {
        //run the soap server in non wsdl mode
        $server = new \SoapServer(null);
    }
}

