<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Datetime;
use AppBundle\Form\CommentType;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Vote;

class VoteController extends Controller
{

    public function addLikeAction(Request $request, $idPost)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();

        $post = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->findOneById($idPost);
        $vote = $this->getDoctrine()->getRepository('AppBundle:vote')
            ->findOneBy(['post' => $post, 'user' => $this->getUser()]);

        if (!$vote) {
            $vote = new Vote();
            $vote->setPost($post);
            $vote->setUser($this->getUser());
            $post->setVotePlus($post->getVoteMoins()+1);
        }
        else{
            if(!$vote->getVote()){
                $post->setVotePlus($post->getVotePlus()+1);
                $post->setVoteMoins($post->getVoteMoins()-1);
            }
        }
        $vote->setVote(true);

        $em->persist($post);
        $em->persist($vote);
        $em->flush();
        return $this->redirectToRoute('onePost', array('idPost' => $idPost));
    }

    public function addDislikeAction(Request $request, $idPost)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();

        $post = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->findOneById($idPost);
        $vote = $this->getDoctrine()->getRepository('AppBundle:vote')
            ->findOneBy(['post' => $post, 'user' => $this->getUser()]);
        if (!$vote) {
            $vote = new Vote();
            $vote->setPost($post);
            $vote->setUser($this->getUser());
            $post->setVoteMoins($post->getVoteMoins()+1);
        }
        else {
            if($vote->getVote()){
                $post->setVoteMoins($post->getVoteMoins()+1);
                $post->setVotePlus($post->getVotePlus()-1);
            }
        }

        $vote->setVote(false);

        $em->persist($post);
        $em->persist($vote);
        $em->flush();
        return $this->redirectToRoute('onePost', array('idPost' => $idPost));
    }

}