<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231230111912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_images DROP FOREIGN KEY FK_A15178AB54177093');
        $this->addSql('DROP INDEX IDX_A15178AB54177093 ON room_images');
        $this->addSql('ALTER TABLE room_images ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP room_id, CHANGE image_path image_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_images ADD room_id INT DEFAULT NULL, DROP updated_at, CHANGE image_name image_path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE room_images ADD CONSTRAINT FK_A15178AB54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A15178AB54177093 ON room_images (room_id)');
    }
}
