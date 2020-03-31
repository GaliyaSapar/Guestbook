<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    /**
     * @Route("/hello/{name}", name="homepage")
     */
    public function index(string $name = '')
    {
//        return $this->render('conference/index.html.twig', [
//            'controller_name' => 'ConferenceController',
//        ]);
        $greet = '';
        if ($name) {
            $greet = sprintf('<h1>Hello %s! </h1>', htmlspecialchars($name));
        }

        return new Response(
            "<html>
                        <body>
                            $greet
                            <img src = '/images/unnamed.jpg'/>
                        </body>
                    </html>"
        );
    }
}
