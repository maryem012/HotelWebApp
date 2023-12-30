<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231230135745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel_images ADD hotel_id INT NOT NULL');
        $this->addSql('ALTER TABLE hotel_images ADD CONSTRAINT FK_7CF56C0D3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_7CF56C0D3243BB18 ON hotel_images (hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel_images DROP FOREIGN KEY FK_7CF56C0D3243BB18');
        $this->addSql('DROP INDEX IDX_7CF56C0D3243BB18 ON hotel_images');
        $this->addSql('ALTER TABLE hotel_images DROP hotel_id');
    }
}
