<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250727070000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add performance indexes';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE INDEX IDX_activity_action ON activity (action)');
        $this->addSql('CREATE INDEX IDX_activity_timestamp ON activity (timestamp)');
        $this->addSql('CREATE INDEX IDX_visit_date ON visit (date)');
        $this->addSql('CREATE INDEX IDX_revenue_month ON revenue (month)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX IDX_activity_action');
        $this->addSql('DROP INDEX IDX_activity_timestamp');
        $this->addSql('DROP INDEX IDX_visit_date');
        $this->addSql('DROP INDEX IDX_revenue_month');
    }
}