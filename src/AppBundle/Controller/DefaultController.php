<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\Status;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findByOrderedByDate();

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
        $user = $this->getUser();

        if (null === $user) {
            throw new AccessDeniedHttpException();
        }

        $status = new Status($message, $user);
        $status->setType('like');

        $em = $this->getDoctrine()->getManager();
        $em->persist($status);
        $em->flush();

        return $this->redirect($this->generateUrl('homepage'));
    }
}
