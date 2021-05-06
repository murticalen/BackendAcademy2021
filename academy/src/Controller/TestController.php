<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestController
 * @Route("/test")
 *
 * @package App\Controller
 */
class TestController extends AbstractController
{
    /**
     * @Route("/test")
     */
    public function testAction()
    {
        return $this->json(["test" => "1"]);
    }

}