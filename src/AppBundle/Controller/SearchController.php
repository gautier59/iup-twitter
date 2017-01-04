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
        $terms = $request->get('term');

        // On regarde si on passé un critère sur le user (from:USER)
        preg_match('/from:[A-z]+/', $terms, $username);
        $username = str_replace('from:', '', $username);
        if ([] != $username) {
            $cleanedTerms = str_replace('from:'.$username[0], '', $terms);
            $terms = preg_split('/ /', $cleanedTerms, -1, PREG_SPLIT_NO_EMPTY);
        }

        if (false === is_array($terms)) {
            $terms = [$terms];
        }

        $terms = trim(implode(' ', $terms));

        // On empêche les recherches trop courtes
        if (1 >= strlen($terms)) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findByUsername($username);

        $messages = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->findBySearchTermsAndByUser($terms, $user);

        return $this->render('default/index.html.twig', [
            'messages' => $messages,
        ]);
    }
}
