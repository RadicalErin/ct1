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
    public function showAction(Request $request){
        $formUser = new User(null, null, null, []);
        $authenForm = $this->createForm(AuthenticationType::class, $formUser);
        $authenForm->handleRequest($request);

        if($authenForm->isSubmitted() && $authenForm->isValid()){
            return new Response("potato");
        }

        return $this->render(
            "@App/index.html.twig",
            array(
                'authen_form' => $authenForm->createView()
            )
        );
    }
}
