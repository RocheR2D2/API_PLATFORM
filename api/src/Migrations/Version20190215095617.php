<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215095617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE price_id_seq CASCADE');
        $this->addSql('DROP TABLE price');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT fk_c257e60e528716ec');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT fk_c257e60e897f2cf6');
        $this->addSql('DROP INDEX idx_c257e60e897f2cf6');
        $this->addSql('DROP INDEX idx_c257e60e528716ec');
        $this->addSql('ALTER TABLE flight ADD flights INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flight DROP flights_arrival');
        $this->addSql('ALTER TABLE flight DROP gate_id');
        $this->addSql('CREATE INDEX IDX_C257E60EFC74B5EA ON flight (flights)');
        $this->addSql('ALTER TABLE user_account ADD sex BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE user_account DROP "boolean"');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE price_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE price (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE user_account ADD "boolean" VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user_account DROP sex');
        $this->addSql('DROP INDEX IDX_C257E60EFC74B5EA');
        $this->addSql('ALTER TABLE flight ADD gate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flight RENAME COLUMN flights TO flights_arrival');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT fk_c257e60e528716ec FOREIGN KEY (flights_arrival) REFERENCES airport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT fk_c257e60e897f2cf6 FOREIGN KEY (gate_id) REFERENCES gate (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c257e60e897f2cf6 ON flight (gate_id)');
        $this->addSql('CREATE INDEX idx_c257e60e528716ec ON flight (flights_arrival)');
    }
}
