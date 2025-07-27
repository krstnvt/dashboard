<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function register(string $name, string $password): User
    {
        $user = new User();
        $user->setName($name);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        $user->setCreatedAt(new \DateTimeImmutable());

        $this->userRepository->getEntityManager()->persist($user);
        $this->userRepository->getEntityManager()->flush();

        return $user;
    }

    public function findByName(string $name): ?User
    {
        return $this->userRepository->findOneBy(['name' => $name]);
    }
}