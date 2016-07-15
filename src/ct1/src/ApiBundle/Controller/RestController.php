<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Post;
use AppBundle\Form\Type\PostType;

class RestController extends FOSRestController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function newPostAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if(
            empty($request->get("user")) ||
            !$em->getRepository("AppBundle:User")->findOneBy(array('username' => $request->get("user")))
        ){
            return new Response("error");
        }

        $newPost = new Post();
        $newPost
            ->setAuthor($em->getRepository("AppBundle:User")->findOneBy(array('username' => $request->get("user"))))
            ->setText($request->get("content"));
        $em->persist($newPost);
        $em->flush();

        $postForm = $this->createForm(PostType::class);
        return $this->render(
            "@App/posts.html.twig",
            array(
                'post_form' => $postForm->createView()
            )
        );
    }
}
