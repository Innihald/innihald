<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200930145823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create tables: document, ocr, physical_file';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE document_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ocr_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE physical_file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE document (id INT NOT NULL, ocr_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8698A76CEC46584 ON document (ocr_id)');
        $this->addSql('CREATE TABLE ocr (id INT NOT NULL, data TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE physical_file (id INT NOT NULL, document_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E804DBDCC33F7837 ON physical_file (document_id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76CEC46584 FOREIGN KEY (ocr_id) REFERENCES ocr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE physical_file ADD CONSTRAINT FK_E804DBDCC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE physical_file DROP CONSTRAINT FK_E804DBDCC33F7837');
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A76CEC46584');
        $this->addSql('DROP SEQUENCE document_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ocr_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE physical_file_id_seq CASCADE');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE ocr');
        $this->addSql('DROP TABLE physical_file');
    }
}
