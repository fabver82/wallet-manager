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
        $movements = $this->movementRepo->findBy(['user' => $this->getUser()]);
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
        $movement->setUser($this->getUser());

        $this->movementRepo->add($movement,true);
        return new JsonResponse(['status' => 201],Response::HTTP_CREATED);
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
    #[Route('/api/balance', name: 'get_balance', methods: ['GET'])]
    public function balance(): JsonResponse
    {

        $incomes = $this->movementRepo->getTotal('income',$this->getUser());
        $expenses = $this->movementRepo->getTotal('expense',$this->getUser());
        $balance = $incomes - $expenses;
        $totals = [
            'incomes'=> $incomes,
            'expenses' => $expenses,
            'balance'=>$balance
        ];
        return new JsonResponse($totals,Response::HTTP_OK);
    }
}
