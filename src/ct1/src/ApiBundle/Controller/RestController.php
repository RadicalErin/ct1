<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Post;

class RestController extends FOSRestController
{
    /**
     * @param Request $request
     * @return Response
     * @Get("/new-post-action")
     */
    public function newPostAction(Request $request)
    {
        echo($request); die();
    }
}
