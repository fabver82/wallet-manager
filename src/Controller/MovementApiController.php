<?php

namespace App\Controller;

use App\Entity\AccountMovement;
use App\Repository\AccountMovementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovementApiController extends AbstractController
{
    private $movementRepo;
    public function __construct(AccountMovementRepository $movementRepo)
    {
        $this->movementRepo = $movementRepo;
    }


    #[Route('/api/movements', name: 'all_movements', methods: ['GET'])]
    public function index(): JsonResponse
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

    #[Route('/api/movements/add', name: 'add_movement', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(),true);

        $movement = new AccountMovement();
        $movement->setType($data['type']);
        $movement->setAmount($data['amount']);
        $movement->setComment($data['comment']);

        $this->movementRepo->add($movement,true);
        return new JsonResponse(['status' => "Movement added!"],Response::HTTP_CREATED);
    }

    #[Route('/api/movements/{id}', name: 'get_one_movement', methods: ['GET'])]
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
