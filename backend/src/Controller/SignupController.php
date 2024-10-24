<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class SignupController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface      $em,
        private readonly UserRepository              $repository,
        private readonly UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    #[Route('/signup', name: 'app_signup')]
    public function index(Request $request): Response
    {
        $decoded = json_decode($request->getContent());
        foreach ($decoded as $item) {
            if ($item === null || $item === "") {
                return new Response(json_encode(['message' => 'Empty fields']),
                    Response::HTTP_CONFLICT,
                    ['Content-Type' => 'application/json']);
            }
        }
        $email = $decoded->email;
        if ($this->repository->findBy(['email' => $email])) {
            return new Response(json_encode(['message' => 'User exist']),
                Response::HTTP_CONFLICT,
                ['Content-Type' => 'application/json']);
        }
        $pwd = $decoded->password;
        if (strlen($pwd) < 5) {
            return new Response(json_encode(['message' => 'Password is short']),
                Response::HTTP_LENGTH_REQUIRED,
                ['Content-Type' => 'application/json']);
        }
        $firstName = $decoded->first_name;
        $lastName = $decoded->last_name;

        $user = new User();
        $user->setPassword($this->passwordHasher->hashPassword($user, $pwd));
        $user->setEmail($email);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $this->em->persist($user);
        $this->em->flush();

        return new Response(json_encode(['message' => 'Registered Successfully']),
            Response::HTTP_CREATED,
            ['Content-Type' => 'application/json']);
    }
}