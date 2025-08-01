<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250731140238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice RENAME INDEX idx_90651744881ecfa7 TO IDX_906517446BF700BD');
        $this->addSql('ALTER TABLE invoice RENAME INDEX idx_90651744dc2902e0 TO IDX_9065174419EB6921');
        $this->addSql('ALTER TABLE invoice_status CHANGE name name VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice RENAME INDEX idx_9065174419eb6921 TO IDX_90651744DC2902E0');
        $this->addSql('ALTER TABLE invoice RENAME INDEX idx_906517446bf700bd TO IDX_90651744881ECFA7');
        $this->addSql('ALTER TABLE invoice_status CHANGE name name VARCHAR(255) NOT NULL');
    }
}
