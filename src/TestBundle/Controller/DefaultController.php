<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration;

use TestBundle\MessageManager\Service\MessageGenerator;

use Doctrine\ORM\EntityManagerInterface;
use TestBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    protected $messageGenerator;

    protected $container;

   
    public function __construct() 
    {
        // $this->container = $container;
        // $messageGenerator = $this->container->get(MessageGenerator::class);
        // echo $messageGenerator;die;
        
        // $this->messageGenerator = $messageGenerator;
    }
     
    /**
     * @Route("/products")
     */
    public function listAction()
    {
        $data = array();
        $messageGenerator = $this->container->get(MessageGenerator::class);
        
        $data['message'] =  $messageGenerator->getHappyMessage();

        return $this->render('@Test/Default/index.html.twig', $data);
    }

     /**
     * @Route("/products/add")
     */
    public function addAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new User();
        $product->setName('Keyboard');
        $product->setDescription('Ergonomic and stylish!');

        $entityManager->persist($product);
        
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }
}
