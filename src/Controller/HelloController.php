<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route(path="/hi/{name}", name="hello")
     * @param string $name
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function hello(string $name,Request $request): Response
    {

        $personNames = ['XXX', 'YYY', 'VVV'];
        return $this->render('hello/hi.html.twig', ['name' => "$name", 'personNames' => $personNames]);

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
     * @Route(path="/page/{author}/{page}", requirements={"page" = "\d+"})
     * @param int $page
     * @param string $author
     * @return Response
     */
    public function page(string $author, int $page = 1): Response
    {

        return new Response("Welcome on page $page for $author");
    }

}