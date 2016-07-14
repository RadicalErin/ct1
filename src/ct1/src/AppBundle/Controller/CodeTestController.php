<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\Type\AuthenticationType;
use AppBundle\Form\Type\LogoutType;

class CodeTestController extends Controller
{
    /**
     * @Route("/test")
     */
    public function showAction(Request $request){
        $formUser = new User(null, null, null, []);
        $authenForm = $this->createForm(AuthenticationType::class, $formUser);
        $authenForm->handleRequest($request);
        $logoutForm = $this->createForm(LogoutType::class);
        $logoutForm->handleRequest($request);

        if(
            ($authenForm->isSubmitted() && $authenForm->isValid()) ||
            ($logoutForm->isSubmitted() && $logoutForm->isValid())
        ){
            return new Response("potato");
        }

        return $this->render(
            "@App/index.html.twig",
            array(
                'authen_form' => $authenForm->createView(),
                'logout_form' => $logoutForm->createView()
            )
        );
    }
}
