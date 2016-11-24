<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
         // Récupérer la liste des messages en base
        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findByOrderedByDate();

        //Les envoyer à la vue

        return $this->render('default/index.html.twig', [
            'messages' => $messages,
        ]);
    }

    /**
     * @param Message $message
     *
     * @Route("/like/{id}", requirements={"id" = "\d+"}, name="like")
     */
    public function likeAction(Message $message)
    {
        // Stocker dans la table status le fait que mon user a aimé le message
        $user = $this->getUser();



    }
}
