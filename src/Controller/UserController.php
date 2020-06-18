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
     * @param EntityManagerInterface $em
     * @Route(path="/create")
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        if ('POST' === $request->getMethod()) {
            $user = new User($request->get('name', ''));
            $user->setSurname($request->get('surname'));

            //persist przyjmuje tylko obiekt encji
            $em->persist($user);
            //flush - skonczylismy edycje naszych encji i doctrine powinien uzupelnic dane w bazie
            $em->flush();

        } else {
            $user = new User('');
        }

        return $this->render('user/create.html.twig', [
            'user' => $user
        ]);

    }

}