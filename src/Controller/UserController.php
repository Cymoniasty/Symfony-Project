<?php


namespace App\Controller;

use App\Entity\User;
use App\Type\UserType;
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
        $user = new User('');

        $form = $this->createForm(UserType::class, $user);
        //wypełnianie wartości w user
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //persist przyjmuje tylko obiekt encji
            $em->persist($user);
            //flush - skonczylismy edycje naszych encji i doctrine powinien uzupelnic dane w bazie
            $em->flush();

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
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

    /**
     * @param User $user
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * @Route(path="/update/{id}", name="update_user")
     */
    public function update(User $user, EntityManagerInterface $em, Request $request): Response
    {

        if ('POST' === $request->getMethod()) {
            $user->setName($request->get('name', ''));
            $user->setSurname($request->get('surname', ''));
            $em->flush();

            return $this->redirectToRoute("user_list");
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
        ]);
    }

}