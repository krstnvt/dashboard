<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $user = new User();
        $user->setName('testuser');
        $user->setPassword('hashedpassword');
        $user->setCreatedAt(new \DateTimeImmutable());

        $this->assertEquals('testuser', $user->getName());
        $this->assertEquals('hashedpassword', $user->getPassword());
        $this->assertInstanceOf(\DateTimeImmutable::class, $user->getCreatedAt());
    }

    public function testUserIdentifier(): void
    {
        $user = new User();
        $user->setName('testuser');

        $this->assertEquals('testuser', $user->getUserIdentifier());
    }

    public function testUserRoles(): void
    {
        $user = new User();
        
        $roles = $user->getRoles();
        $this->assertIsArray($roles);
        $this->assertContains('ROLE_USER', $roles);
    }

    public function testEraseCredentials(): void
    {
        $user = new User();
        
        // Should not throw any exception
        $user->eraseCredentials();
        $this->assertTrue(true);
    }
}