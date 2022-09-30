<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930141344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cv_picture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cv_picture (id INT NOT NULL, cv_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D521CC7CFE419E2 ON cv_picture (cv_id)');
        $this->addSql('ALTER TABLE cv_picture ADD CONSTRAINT FK_5D521CC7CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv_base_info (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cv_picture_id_seq CASCADE');
        $this->addSql('ALTER TABLE cv_picture DROP CONSTRAINT FK_5D521CC7CFE419E2');
        $this->addSql('DROP TABLE cv_picture');
    }
}
