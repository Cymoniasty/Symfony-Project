<?php


namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route(path="/user")
 */
class UserController extends AbstractController
{

    /**
     * @Route(path="/create")
     */
    public function create()
    {
        $user = new User('');
        return $this->render('user/create.html.twig', [
            'user' => $user,
        ]);

    }

}