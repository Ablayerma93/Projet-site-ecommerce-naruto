<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Header;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{   private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {

        //$mail = new mail();
        //$mail->send('abdoulaye33093@gmail.com', 'Abdoulaye', 'Test', 'Bonjour Abdoulaye, es ce que tu l\'as reçu ? ');

        $product = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('home/index.html.twig', [
            'products' => $product,
            'headers' => $headers
        ]);
    }
}
