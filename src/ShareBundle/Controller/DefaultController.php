<?php

namespace ShareBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TestBundle\MessageManager\Service\MessageGenerator;


class DefaultController extends Controller
{
    /**
     * @Route("/share")
     */
    public function indexAction()
    {
        $data = array();
        $messageGenerator = $this->container->get(MessageGenerator::class);
        
        $data['message'] =  $messageGenerator->getHappyMessage();

        return $this->render('@Share/Default/index.html.twig', $data);

    }
}
