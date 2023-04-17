<?php

namespace App\Controller;

use App\Entity\Fruits;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function __construct(
        public EntityManagerInterface $em
    )
    {
        
    }

    #[Route('/', name: 'fruit_index')]
    public function index()
    {
        return $this->render('index.html.twig');
    }

    #[Route('/list', name: 'fruit_list', methods: ['GET', 'POST'])]
    public function list(Request $request): JsonResponse
    {
        $postData = $request->getContent();
        $postData = json_decode($postData, true);

        $page = $request->query->get('page', 1);
        $pageSize = 20;

        $query = $this->em
            ->getRepository(Fruits::class)
            ->createQueryBuilder('f')
            ->orderBy('f.is_favorite', 'DESC');

        if(
            $postData !== null &&
            array_key_exists('name', $postData) &&
            $postData['name'] !== null
        ) {
            $nameParameter = $postData['name'];
            $query->andWhere("f.name LIKE '%$nameParameter%'");
        }

        if(
            $postData !== null &&
            array_key_exists('family', $postData) &&
            $postData['family'] !== null
        ) {
            $familyParameter = $postData['family'];
            $query->andWhere("f.family LIKE '%$familyParameter%'");
        }

        $query
            ->setFirstResult($pageSize * ($page-1))
            ->setMaxResults($pageSize);

        $paginator = new Paginator($query, $fetchJoinCollection = true);

        $totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        $fruits = $paginator->getQuery()->getResult(Query::HYDRATE_ARRAY);

        return $this->json([
            'data' => $fruits,
            'pagination' => [
                'total' => $totalItems,
                'current' => $page,
                'pagesCount' => $pagesCount
            ],
        ]);
    }

    #[Route('/favorite', name: 'fruit_favorite', methods: ['POST'])]
    public function makeFavorite(Request $request)
    {
        $this->em->getConnection()->prepare('UPDATE fruits set is_favorite = false')->execute();

        $postData = $request->getContent();
        $postData = json_decode($postData, true);

        foreach($postData as $id) {
            $entity = $this->em->getRepository(Fruits::class)->find($id);
            $entity->setIsFavorite(true);

            $this->em->persist($entity);
            $this->em->flush();
        }

        return $this->json([]);
    }
}
