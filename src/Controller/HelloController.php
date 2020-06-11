<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    /**
     * @param string $name
     * @Route(path="/hi/{name}")
     * @param Request $request
     * @return Response
     */
    public function hi(string $name, Request $request): Response
    {
        $helloText = "Cześc " . $name;
        $param1 = $request->get('param1');
        return new Response("<html><body><h1>$helloText</h1><h2>$param1</h2></body></html>");
    }


}