<?php


namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route(path="/user")
 */
class UserController extends AbstractController
{

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @Route(path="/create")
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ('POST' === $request->getMethod()) {
            $user = new User($request->get('name', ''));
            $user->setSurname($request->get('surname'));

        } else {
            $user = new User('');
        }

        return $this->render('user/create.html.twig', [
            'user' => $user
        ]);

    }

}