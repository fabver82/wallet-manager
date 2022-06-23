<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'api_login', methods: ['POST'])]
    public function login(#[CurrentUser] ?User $user): Response
    {
//        TODO : return null when autenticate the first time but worked after refreshing the page
        dump($user);
        if ($user===null){
            return $this->json([
                'message' => "missing credentials",
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token ='token';
        return $this->json([
            'user' => $user->getUserIdentifier(),
            'token'=>$token,
        ]);
    }
    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout()
    {

    }
}
