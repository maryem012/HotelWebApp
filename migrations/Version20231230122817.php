<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231230122817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room DROP updated_at');
        $this->addSql('ALTER TABLE room_images ADD CONSTRAINT FK_A15178AB54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_A15178AB54177093 ON room_images (room_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_images DROP FOREIGN KEY FK_A15178AB54177093');
        $this->addSql('DROP INDEX IDX_A15178AB54177093 ON room_images');
        $this->addSql('ALTER TABLE room ADD updated_at DATETIME DEFAULT NULL');
    }
}
