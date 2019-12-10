<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\NewArticleType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/new_article", name="new")
     */
    public function new(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(NewArticleType::class, $article);

        //On récupère les informations du formulaire de création d'un article
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $now = date_create(date('Y-m-d H:i:s'));

            //On complète les informations de l'article manuellement
            $article->setAuthor($this->getUser()->getUsername());
            $article->setPublicationDate($now);

            //On enregistre le nouvel article
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($article);
	        $em->flush();

	        return $this->redirectToRoute('home');
	    }

        return $this->render('article/new.html.twig', [
	        'form'  =>  $form->createView()
	    ]);
    }

    /**
	 * @Route("/edit/{id}", name="edit")
	 */ 
	public function edit(Article $article, Request $request){
        //Si l'utilisateur connecté correspond à l'auteur de l'article
        if($article->getAuthor() == $this->getUser()->getUsername()) {
            //On lui permet de modifier l'article
            $form = $this->createForm(NewArticleType::class, $article);
            $form->handleRequest($request);
	    
            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();

                return $this->redirectToRoute('home');
            }

            return $this->render('article/new.html.twig', [
                'form'  =>  $form->createView()
            ]);
        }
        //Sinon, on le redirige vers l'accueil
        else {
            return $this->redirectToRoute('home');
        }

	    
	}
}
