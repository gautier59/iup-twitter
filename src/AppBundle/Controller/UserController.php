<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/u/{username}", name="user_message")
     */
    public function indexAction(User $user)
    {
        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findByOrderedByDateAndByUser($user);

        return $this->render('default/index.html.twig', [
            'messages' => $messages,
        ]);
    }
}
