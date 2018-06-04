<?php

namespace Ipallet\ZarinpalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IpalletZarinpalBundle:Default:index.html.twig');
    }
}
