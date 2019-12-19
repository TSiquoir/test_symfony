<?php
// src/Controller/BlogController.php
namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController  
{
     /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $articles = $this->getDoctrine()
        ->getRepository(Article::class)
        ->findAll();

        return $this->render('blog/home.html.twig', [
            'articles' => $articles
        ]);
    }
}