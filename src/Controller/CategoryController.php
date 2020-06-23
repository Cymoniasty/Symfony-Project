<?php


namespace App\Controller;

use App\Entity\Category;
use App\Type\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 * @Route(path="/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route(path="/create", name="category_create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function createCategory(Request $request, EntityManagerInterface $em): Response
    {
        $category = new Category('');

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_list');
        }

        return $this->render('category/category.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @param EntityManagerInterface $em
     * @return Response
     * @Route(path="/list", name="category_list")
     */
    public function showCategory(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Category::class);
        $categories = $repository->findAll();

        return $this->render('category/list.html.twig', [
            'categories' => $categories
        ]);
    }
}