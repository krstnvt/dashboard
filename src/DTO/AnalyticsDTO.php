<?php

namespace App\DTO;

class AnalyticsDTO
{
    public function __construct(
        public readonly int $revenue,
        public readonly int $users,
        public readonly float $ctr,
        public readonly int $signups
    ) {
    }

    public function toArray(): array
    {
        return [
            'revenue' => $this->revenue,
            'users' => $this->users,
            'ctr' => $this->ctr,
            'signups' => $this->signups,
        ];
    }
}