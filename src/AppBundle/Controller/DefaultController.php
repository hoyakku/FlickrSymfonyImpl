<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/tag", name="tagpage")
     */
    public function tagImageAction(Request $request)
    {
        $tags = $request->get('tags');
        $getClusterPhotos = $this->get('custom.flickr.api')->getTagsClusterPhotos($tags);
        $resultWithUrl = array();

//        if(isset($getClusterPhotos)){
        foreach ($getClusterPhotos->photo as $photo){
//            print_r($photo);
            $resultWithUrl[] = array('url' => $this->get('custom.flickr.api')->buildFlickPhotoUrl($photo));
        }

        return $this->render("photos.html.twig", array('photourls' => $resultWithUrl));
    }
}
