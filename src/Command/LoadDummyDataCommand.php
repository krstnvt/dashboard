<?php

namespace App\Command;

use App\Entity\Activity;
use App\Entity\DeviceStat;
use App\Entity\Revenue;
use App\Entity\User;
use App\Entity\Visit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:load-dummy-data')]
class LoadDummyDataCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Loading dummy data...');
        
        // Check if data already exists
        $existingUsers = $this->entityManager->getRepository(User::class)->count([]);
        if ($existingUsers > 0) {
            $output->writeln('Data already exists, skipping...');
            return Command::SUCCESS;
        }

        // Users
        $user = new User();
        $user->setName('admin');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        $user->setCreatedAt(new \DateTimeImmutable());
        $this->entityManager->persist($user);

        for ($i = 1; $i <= 50; $i++) {
            $user = new User();
            $user->setName("user$i");
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            $user->setCreatedAt(new \DateTimeImmutable("-$i days"));
            $this->entityManager->persist($user);
        }

        // Revenue
        $months = ['2024-01', '2024-02', '2024-03', '2024-04', '2024-05', '2024-06'];
        foreach ($months as $month) {
            $revenue = new Revenue();
            $revenue->setMonth($month);
            $revenue->setAmount(rand(30000, 60000));
            $this->entityManager->persist($revenue);
        }

        // Activities
        $actions = ['click', 'signup', 'view', 'purchase'];
        for ($i = 0; $i < 100; $i++) {
            $activity = new Activity();
            $activity->setAction($actions[array_rand($actions)]);
            $activity->setTimestamp(date('Y-m-d H:i:s', strtotime("-$i hours")));
            $activity->setValue(rand(1, 10));
            $this->entityManager->persist($activity);
        }

        // Visits
        for ($i = 0; $i < 30; $i++) {
            $visit = new Visit();
            $visit->setDate(new \DateTimeImmutable("-$i days"));
            $visit->setCount(rand(100, 500));
            $this->entityManager->persist($visit);
        }

        // Device Stats
        $devices = ['desktop', 'mobile', 'tablet'];
        foreach ($devices as $device) {
            $deviceStat = new DeviceStat();
            $deviceStat->setDeviceType($device);
            $deviceStat->setCount(rand(1000, 5000));
            $this->entityManager->persist($deviceStat);
        }

        $this->entityManager->flush();

        $output->writeln('Dummy data loaded successfully!');
        return Command::SUCCESS;
    }
}