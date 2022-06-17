<?php

namespace App\Controller;

use App\Repository\AccountMovementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    private $movementRepo;
    public function __construct(AccountMovementRepository $movementRepo)
    {
        $this->movementRepo = $movementRepo;
    }
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/add", name="add_movement", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        //validate date
        dump($data);
//        $this->movementRepo->add($data,true);
       return new JsonResponse(['status' => "Movement added!"],Response::HTTP_CREATED);
    }
    /**
     * @Route("/movements", name="all_movements", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $movements = $this->movementRepo->findAll();
        $data=[];

        foreach($movements as $movement)
        {
            $data[] = [
                'id' => $movement->getId(),
                'comment' => $movement->getComment(),
                'type' => $movement->getType(),
                'amount' => $movement->getAmount(),
            ];
        }

        return new JsonResponse($data,Response::HTTP_OK);
    }
    /**
     * @Route("/{id}", name="get_one_movement", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $movement = $this->movementRepo->findOneBy(['id'=>$id]);
        $data = [
            'id' => $movement->getId(),
            'comment' => $movement->getComment(),
            'type' => $movement->getType(),
            'amount' => $movement->getAmount(),
        ];
        return new JsonResponse($data,Response::HTTP_OK);
    }
}
