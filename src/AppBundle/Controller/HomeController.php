<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;


class HomeController extends Controller
{

    public function getHomeAction(Request $request)
    {
        $posts = $this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->findAll();


        return $this->render('default/home.html.twig', array(
            'posts' => $posts,
        ));
    }


}
