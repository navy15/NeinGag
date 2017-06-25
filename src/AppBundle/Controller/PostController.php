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

class PostController extends Controller
{

    /**
     *
     * Get All the post
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getHomeAction(Request $request)
    {
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findAll();


        return $this->render('default/home.html.twig', array(
            'posts' => $posts,
        ));
    }


    /**
     *
     * Action to add a post
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addPostAction(Request $request)
    {
		// 1) build the form
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $post->getImage();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images'),
                $fileName
            );

            $post->setImage($fileName);
            $post->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('default/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     *
     *Add a comment to the selected post
     *
     * @param $idPost
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }
        return $this->render('default/onePost.html.twig', array(
            'form' => $form->createView(),
            'post' => $post,
        ));
    }



    public function getPostApiAction($idPost, Request $request)
    {

        $post = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findOneById($idPost);

        $thePost[] = [
            'id' => $post->getId(),
            'user' => $post->getUser(),
            'image' => $post->getImage(),
            'votePlus' => $post->getVotePlus(),
            'voteMoins' => $post->getVoteMoins(),
            'title' => $post->getTitle(),
            'comments' => $post->getComments(),
            'vote' => $post->getVote()
        ];

        return new JsonResponse($thePost);
    }

    public function getAllPostApiAction( Request $request)
    {

        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findAll();

        foreach ($posts as $key=>  $post){
            $thePost[$post->getId()] = [
                'id' => $post->getId(),
                'user' => $post->getUser(),
                'image' => $post->getImage(),
                'votePlus' => $post->getVotePlus(),
                'voteMoins' => $post->getVoteMoins(),
                'title' => $post->getTitle(),
                'comments' => $post->getComments(),
                'vote' => $post->getVote()
            ];
        }

        return new JsonResponse($thePost);
    }

    public function addCommentApiAction($idPost, Request $request)
    {

        $post = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findOneById($idPost);
        // 1) build the form
        $comment = new Comment();

        $comment->setDate(new DateTime());
        $comment->setUser($this->getUser());
        $comment->setPost($post);
        $data = $request->get('comment');
        $comment->setText($data);


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

        $thePost[] = [
            'id' => $post->getId(),
            'user' => $post->getUser(),
            'image' => $post->getImage(),
            'votePlus' => $post->getVotePlus(),
            'voteMoins' => $post->getVoteMoins(),
            'title' => $post->getTitle(),
            'comments' => $post->getComments(),
            'vote' => $post->getVote()
        ];

        return new JsonResponse($thePost);
    }




}
