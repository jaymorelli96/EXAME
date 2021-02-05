<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/eshop/message", name="message")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $message = $request->get('msg');
        return $this->render('message/message.html.twig', [
            'message' => $message,
        ]);
    }

    /**
     * @Route("/eshop/message_logout", name="message_logout")
     * @return Response
     */
    public function message_logout(): Response
    {
        return $this->render('message/message.html.twig', [
            'message' => 'See you later!',
        ]);
    }



}
