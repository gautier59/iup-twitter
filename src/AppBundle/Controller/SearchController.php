<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        $term = $request->get('term');

        // On empêche les recherches trop courtes
        if (1 >= strlen($term)) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findBySearchTerm($term);

        return $this->render('default/index.html.twig', [
            'messages' => $messages,
        ]);
    }
}
