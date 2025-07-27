<?php

namespace App\Tests\Command;

use App\Command\LoadDummyDataCommand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use App\Repository\UserRepository;

class LoadDummyDataCommandTest extends TestCase
{
    private LoadDummyDataCommand $command;
    private EntityManagerInterface|MockObject $entityManager;
    private UserPasswordHasherInterface|MockObject $passwordHasher;
    private UserRepository|MockObject $userRepository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->passwordHasher = $this->createMock(UserPasswordHasherInterface::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        
        $this->entityManager
            ->method('getRepository')
            ->willReturn($this->userRepository);
            
        $this->command = new LoadDummyDataCommand($this->entityManager, $this->passwordHasher);
    }

    public function testExecuteWithNoExistingUsers(): void
    {
        $this->userRepository
            ->expects($this->once())
            ->method('count')
            ->willReturn(0);

        $this->passwordHasher
            ->method('hashPassword')
            ->willReturn('hashed_password');

        $this->entityManager
            ->expects($this->atLeastOnce())
            ->method('persist');

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $application = new Application();
        $application->add($this->command);

        $command = $application->find('app:load-dummy-data');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $this->assertEquals(Command::SUCCESS, $commandTester->getStatusCode());
        $this->assertStringContainsString('Loading dummy data...', $commandTester->getDisplay());
        $this->assertStringContainsString('Dummy data loaded successfully!', $commandTester->getDisplay());
    }

    public function testExecuteWithExistingUsers(): void
    {
        $this->userRepository
            ->expects($this->once())
            ->method('count')
            ->willReturn(5);

        $this->entityManager
            ->expects($this->never())
            ->method('persist');

        $application = new Application();
        $application->add($this->command);

        $command = $application->find('app:load-dummy-data');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $this->assertEquals(Command::SUCCESS, $commandTester->getStatusCode());
        $this->assertStringContainsString('Data already exists, skipping...', $commandTester->getDisplay());
    }
}