<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220922152408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cv_address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cv_base_info_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cv_education_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cv_job_experience_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cv_job_experience_skills_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cv_languages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cv_references_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cv_web_links_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cv_address (id INT NOT NULL, cv_id INT NOT NULL, country VARCHAR(255) NOT NULL, index VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, house_name VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, street_number VARCHAR(255) DEFAULT NULL, apartment_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_46C73CCFCFE419E2 ON cv_address (cv_id)');
        $this->addSql('CREATE TABLE cv_base_info (id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, about TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cv_education (id INT NOT NULL, cv_id INT NOT NULL, institution VARCHAR(255) NOT NULL, faculty VARCHAR(255) NOT NULL, study_field VARCHAR(255) NOT NULL, education_level VARCHAR(255) NOT NULL, status BOOLEAN NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4792779ECFE419E2 ON cv_education (cv_id)');
        $this->addSql('CREATE TABLE cv_job_experience (id INT NOT NULL, cv_id INT NOT NULL, company VARCHAR(255) NOT NULL, job_title VARCHAR(255) NOT NULL, work_load BOOLEAN NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12A28BCCFE419E2 ON cv_job_experience (cv_id)');
        $this->addSql('CREATE TABLE cv_job_experience_skills (id INT NOT NULL, job_id INT NOT NULL, skill VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_13E503BCBE04EA9 ON cv_job_experience_skills (job_id)');
        $this->addSql('CREATE TABLE cv_languages (id INT NOT NULL, cv_id INT NOT NULL, language VARCHAR(255) NOT NULL, level VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3C497A35CFE419E2 ON cv_languages (cv_id)');
        $this->addSql('CREATE TABLE cv_references (id INT NOT NULL, cv_id INT NOT NULL, name VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E0E8B80ECFE419E2 ON cv_references (cv_id)');
        $this->addSql('CREATE TABLE cv_web_links (id INT NOT NULL, cv_id INT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_80098CCACFE419E2 ON cv_web_links (cv_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE cv_address ADD CONSTRAINT FK_46C73CCFCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv_base_info (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_education ADD CONSTRAINT FK_4792779ECFE419E2 FOREIGN KEY (cv_id) REFERENCES cv_base_info (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_job_experience ADD CONSTRAINT FK_12A28BCCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv_base_info (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_job_experience_skills ADD CONSTRAINT FK_13E503BCBE04EA9 FOREIGN KEY (job_id) REFERENCES cv_job_experience (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_languages ADD CONSTRAINT FK_3C497A35CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv_base_info (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_references ADD CONSTRAINT FK_E0E8B80ECFE419E2 FOREIGN KEY (cv_id) REFERENCES cv_base_info (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_web_links ADD CONSTRAINT FK_80098CCACFE419E2 FOREIGN KEY (cv_id) REFERENCES cv_base_info (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cv_address_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cv_base_info_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cv_education_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cv_job_experience_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cv_job_experience_skills_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cv_languages_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cv_references_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cv_web_links_id_seq CASCADE');
        $this->addSql('ALTER TABLE cv_address DROP CONSTRAINT FK_46C73CCFCFE419E2');
        $this->addSql('ALTER TABLE cv_education DROP CONSTRAINT FK_4792779ECFE419E2');
        $this->addSql('ALTER TABLE cv_job_experience DROP CONSTRAINT FK_12A28BCCFE419E2');
        $this->addSql('ALTER TABLE cv_job_experience_skills DROP CONSTRAINT FK_13E503BCBE04EA9');
        $this->addSql('ALTER TABLE cv_languages DROP CONSTRAINT FK_3C497A35CFE419E2');
        $this->addSql('ALTER TABLE cv_references DROP CONSTRAINT FK_E0E8B80ECFE419E2');
        $this->addSql('ALTER TABLE cv_web_links DROP CONSTRAINT FK_80098CCACFE419E2');
        $this->addSql('DROP TABLE cv_address');
        $this->addSql('DROP TABLE cv_base_info');
        $this->addSql('DROP TABLE cv_education');
        $this->addSql('DROP TABLE cv_job_experience');
        $this->addSql('DROP TABLE cv_job_experience_skills');
        $this->addSql('DROP TABLE cv_languages');
        $this->addSql('DROP TABLE cv_references');
        $this->addSql('DROP TABLE cv_web_links');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
