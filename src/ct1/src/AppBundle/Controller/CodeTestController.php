<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\Type\AuthenticationType;

class CodeTestController extends Controller
{
    /**
     * @Route("/test")
     */
    public function showAction(){
        $formUser = new User();
        $authenForm = $this->createForm(AuthenticationType::class, $formUser);

        return $this->render(
            "@App/index.html.twig",
            array(
                'authen_form' => $authenForm->createView()
            )
        );
    }
}
