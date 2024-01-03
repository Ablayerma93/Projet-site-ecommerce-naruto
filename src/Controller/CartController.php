<?php

namespace App\Controller;

use App\Classe\Cart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private $entityManager;
    private $cart;
    public function __construct(EntityManagerInterface $entityManager, Cart $cart)
    {
        $this->entityManager = $entityManager;
        $this->cart = $cart;
    }

    #[Route('/mon-panier', name: 'app_cart')]
    public function index(): Response
    {

        return $this->render('cart/index.html.twig', [
            'cart'=> $this->cart->getFull()
        ]);
    }

    #[Route('/cart/add/{id}', name: 'add_to_cart')]
    public function add($id): Response
    {
        
        $this->cart->add($id);

        return $this->redirectToRoute ('app_cart');
    }


    #[Route('/cart/remove', name: 'remove_my_cart')]
    public function remove(): Response
    {
        
        $this->cart->remove();

        return $this->redirectToRoute ('products');
    }

    #[Route('/cart/delete/{id}', name: 'delete_to_cart')]
    public function delete($id): Response
    {
        
        $this->cart->delete($id);

        return $this->redirectToRoute ('app_cart');
    }

    #[Route('/cart/decrease/{id}', name: 'decrease_to_cart')]
    public function decrease($id): Response
    {
        
        $this->cart->decrease($id);

        return $this->redirectToRoute ('app_cart');
    }

    
}
