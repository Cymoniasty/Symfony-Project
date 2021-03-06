<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HelloController
 * @package App\Controller
 * @Route("/page")
 */
class HelloController extends AbstractController
{
    /**
     * @param string $name
     * @Route(path="/hi/{name}", name="hello")
     * @param Request $request
     * @return Response
     */
    public function hello(string $name, Request $request): Response
    {
        $helloText = "Cześć " . $name;
        $param1 = $request->get('param1');
        return new Response("<html><body><h1>$helloText</h1><h2>$param1</h2></body></html>");
    }

    /**
     * @Route(path="redirect/{action}", requirements={"action"="hello|currentDate"})
     * @param string $action
     * @return RedirectResponse
     * @throws \Exception
     */
    public function moveToAction(string $action): RedirectResponse
    {
        return $this->redirectToRoute($action, ['name' => 'Some name']);

    }

    /**
     * @Route(path="page/{author}/{page}", requirements={"page" = "\d+"})
     * @param int $page
     * @param string $author
     * @return Response
     */
    public function page(string $author, int $page =1): Response
    {

        return new Response("Welcome on page $page for $author");
    }

}