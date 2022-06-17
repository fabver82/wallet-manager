<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login', methods:['POST'])]
    public function login(Request $request): Response
    {
        $user = $this->getUser();
//        if (null ===$user){
//            return $this->json([
//                'message' => "missing credentials",
//            ], Response::HTTP_UNAUTHORIZED);
//        }
        dump($user);
//        $token ='token';
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }
}
