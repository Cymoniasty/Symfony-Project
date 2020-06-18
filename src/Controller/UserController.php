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
     * @Route(path="/create", name="user_create")
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

            return $this->redirectToRoute('user_list');
        } else {
            $user = new User('');
        }

        return $this->render('user/create.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @param EntityManagerInterface $em
     * @return Response
     * @Route(path="/list", name="user_list")
     */
    public function list(EntityManagerInterface $em): Response
    {
        //getRepository - komunikacja z tabela, która nas interesuje - wyciąga dane z tabeli
        $repository = $em->getRepository(User::class);
        //findAll - znajduje wszystkich user'ów w tabeli User
        $users = $repository->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $em
     * @return Response
     * @Route(path="/delete{id}", name="user_delete")
     */
    public function delete(int $id, EntityManagerInterface $em): Response
    {

        $repository = $em->getRepository(User::class);
        $user = $repository->find($id);
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute("user_list");

    }

}