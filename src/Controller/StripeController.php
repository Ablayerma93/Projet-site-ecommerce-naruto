<?php

namespace App\Controller;


use App\Classe\Cart;
use Stripe\Stripe;
use App\Classe\Product;
use Stripe\Checkout\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class StripeController extends AbstractController
{
    
    #[Route('commande/create-session{reference}', name:'stripe_create_session')]
    public function index(Cart $cart)
    {

        $products_for_stripe = [];
        $YOUR_DOMAIN = 'http://127.0.0.1:8000';
     

        foreach ($cart->getFull() as $product) {
            $products_for_stripe[] = [

                'price_data' => [

                    'currency' => 'eur',

                    'unit_amount' => $product['product']->getprice(),

                    'product_data' => [

                        'name' => $product['product']->getName(),

                        'images' => [$YOUR_DOMAIN."/upload/".$product['product']->getIllustration()],

                    ],

                ],

                'quantity' =>  $product['quantity'],
            ];
        }

        
        $products_for_stripe[] = [

            'price_data' => [

                'currency' => 'eur',

                'unit_amount' => $product['product']->getprice(),

                'product_data' => [

                    'name' => $product['product']->getName(),

                    'images' => [$YOUR_DOMAIN."/upload/".$product['product']->getIllustration()],

                ],

            ],

            'quantity' =>  $product['quantity'],
        ];




        Stripe::setApiKey('sk_test_51Nwh3yBiMjkt4cuI1XO5HYWBnc2pvoPamYQq1vJl4jdE6rFKUr1qfnWygbTKCEI8QRVR2qOiANjLuI7iS6IgdilM00v81TmFkT');





        $checkout_session = Session::create([

            'payment_method_types' => ['card'],

            'line_items' => [ $products_for_stripe ],

            'mode' => 'payment',

            'success_url' => $YOUR_DOMAIN . '/success.html',

            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',

        ]);

        $response = new JsonResponse(['id'=> $checkout_session->id]);
        return $response;
    }
}