<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sensio\Bundle\FrameworkExtraBundle\Configuration;

use TestBundle\MessageManager\Service\MessageGenerator;

use Doctrine\ORM\EntityManagerInterface;
use TestBundle\Entity\User;

use Symfony\Component\HttpFoundation\Request;
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

    /**
    * @Route("/users/list", name="admin_ajax_users_list")
    * @Template()
    */
    public function usersListAction(Request $request)
    {

        // echo "<pre>"; 
        // print_r($_GET);die;
        $get = $request->query->all();
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
        * you want to insert a non-database field (for example a counter or static image)
        */
        $columns = array( 'id', 'name', 'description' );
        $get['columns_names'] = &$columns;
        // print_r($get);die;

        $em = $this->getDoctrine()->getEntityManager();

        $rResult = $em->getRepository('TestBundle:User')->ajaxTable($get, true)->getArrayResult();
        // print_r($rResult);die;


        /* Data set length after filtering */
        $filtered = $em->getRepository('TestBundle:User')->getFilteredCount($get);
        // print_r($filtered);die;
        $iFilteredTotal = $filtered;
        
        /*
        * Output
        */
        $output = array(
            // "sEcho" => intval($get['sEcho']),
            "iTotalRecords" => $em->getRepository('TestBundle:User')->getCount(),
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
        
        foreach($rResult as $aRow)
        {
            $row = array();
            for ( $i=0 ; $i<count($columns) ; $i++ ){
                if ( $columns[$i] == "version" ){
                /* Special output formatting for 'version' column */
                $row[] = ($aRow[ $columns[$i] ]=="0") ? '-' : $aRow[ $columns[$i] ];
                }elseif ( $columns[$i] != ' ' ){
                /* General output */
                $row[] = $aRow[ $columns[$i] ];
                }
            }
            $output['aaData'][] = $row;
        }
        unset($rResult);
        
        return new Response(
            json_encode($output)
        );
    }
}
