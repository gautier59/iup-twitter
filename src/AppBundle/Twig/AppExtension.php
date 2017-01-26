<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('ext', array($this, 'ext')),
        );
    }

    public function ext($filepath)
    {
        return strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
    }

    public function getName()
    {
        return 'app_extension';
    }
}
