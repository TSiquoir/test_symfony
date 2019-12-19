<?php
// src/Controller/BlogController.php
namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/article", name="article_")
     */

class ArticleController extends AbstractController  
{
     /**
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        $article = new Article;

        $form = $this->createFormBuilder($article)
        ->add('title', TextType::class)
        ->add('content', TextareaType::class)
        ->add('image', TextType::class, [
            'required' => false
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Créer un article'
        ])->getForm();
       
       $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setDate(new \DateTime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }
        return $this->render('article/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}