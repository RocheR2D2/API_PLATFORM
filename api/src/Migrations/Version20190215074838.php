<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215074838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX uniq_42c8495591f478c5');
        $this->addSql('CREATE INDEX IDX_42C8495591F478C5 ON reservation (flight_id)');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT fk_c257e60eb83297e7');
        $this->addSql('DROP INDEX uniq_c257e60eb83297e7');
        $this->addSql('ALTER TABLE flight DROP reservation_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE flight ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT fk_c257e60eb83297e7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_c257e60eb83297e7 ON flight (reservation_id)');
        $this->addSql('DROP INDEX IDX_42C8495591F478C5');
        $this->addSql('CREATE UNIQUE INDEX uniq_42c8495591f478c5 ON reservation (flight_id)');
    }
}
