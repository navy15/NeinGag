<?php

namespace AppBundle\Controller;

use Datetime;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Entity\Comment;

class OnePostController extends Controller
{

    public function addCommentAction($idPost, Request $request)
    {

        $post = $this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->findOneById($idPost);
        // 1) build the form
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setDate(new DateTime());
            $comment->setUser($this->getUser());
            $comment->setPost($post);

            $tabComments = $post->getComments();
            if($tabComments == null){
                $tabComments = [];
            }
            array_push($tabComments, $comment);
            $post->setComments($tabComments);


            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->render('default/onePost.html.twig', array(
            'form' => $form->createView(),
            'post' => $post,
        ));
    }

    public function addLike($idPost, Request $request){
        $post = $this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->findOneById($idPost);

        $post->addVoteMoins();

        $existingVote = false;
        foreach ($post->getVote() as $key => &$value) {
            if($value->getUser() == $this->getUser() && $value->getPost()->getId() == $idPost){
                $value->setVote(true);
                $existingVote = true;
            }
        }

        if(!$existingVote){
            $vote = new Vote();
            $vote->setUser($this->getUser());
            $vote->setVote(true);
            $vote->setPost($post);
            array_push($post->getVote(), $vote);
            $em = $this->getDoctrine()->getManager();
            $em->persist($vote);
            $em->flush();
        }


    }

    public function addUnlike($idPost, Request $request){
        $post = $this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->findOneById($idPost);

        $post->addVoteMoins();
        $existingVote = false;
        foreach ($post->getVote() as $key => &$value) {
            if($value->getUser() == $this->getUser() && $value->getPost()->getId() == $idPost){
                $value->setVote(false);
                $existingVote = true;
            }
        }

        if(!$existingVote){
            $vote = new Vote();
            $vote->setUser($this->getUser());
            $vote->setVote(false);
            $vote->setPost($post);
            array_push($post->getVote(), $vote);
            $em = $this->getDoctrine()->getManager();
            $em->persist($vote);
            $em->flush();
        }



    }

}
