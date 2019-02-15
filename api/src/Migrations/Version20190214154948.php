<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190214154948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE airport_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE crew_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE terminal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plane_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE flight_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bagage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE price_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE company_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE airport (id INT NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE crew (id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, gender BOOLEAN NOT NULL, birthday TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, user_id INT DEFAULT NULL, flight_id INT DEFAULT NULL, price INT NOT NULL, reservation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C8495591F478C5 ON reservation (flight_id)');
        $this->addSql('CREATE TABLE terminal (id INT NOT NULL, terminals INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F7B15411A5AC518 ON terminal (terminals)');
        $this->addSql('CREATE TABLE plane (id INT NOT NULL, name VARCHAR(255) NOT NULL, place VARCHAR(255) DEFAULT NULL, manufacture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE flight (id INT NOT NULL, flights_arrival INT DEFAULT NULL, company_id INT DEFAULT NULL, reservation_id INT DEFAULT NULL, plane_id INT DEFAULT NULL, gate_id INT DEFAULT NULL, registration_number VARCHAR(255) NOT NULL, duration VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C257E60E528716EC ON flight (flights_arrival)');
        $this->addSql('CREATE INDEX IDX_C257E60E979B1AD6 ON flight (company_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C257E60EB83297E7 ON flight (reservation_id)');
        $this->addSql('CREATE INDEX IDX_C257E60EF53666A8 ON flight (plane_id)');
        $this->addSql('CREATE INDEX IDX_C257E60E897F2CF6 ON flight (gate_id)');
        $this->addSql('CREATE TABLE flight_crew (flight_id INT NOT NULL, crew_id INT NOT NULL, PRIMARY KEY(flight_id, crew_id))');
        $this->addSql('CREATE INDEX IDX_8771DD591F478C5 ON flight_crew (flight_id)');
        $this->addSql('CREATE INDEX IDX_8771DD55FE259F6 ON flight_crew (crew_id)');
        $this->addSql('CREATE TABLE bagage (id INT NOT NULL, reservation_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, weight VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A82C5715B83297E7 ON bagage (reservation_id)');
        $this->addSql('CREATE TABLE price (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE company (id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phonenumber VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE gate (id INT NOT NULL, gates INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B82B9894ECD4B3CE ON gate (gates)');
        $this->addSql('CREATE TABLE user_account (id INT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthday TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, id_number VARCHAR(255) NOT NULL, boolean VARCHAR(255) NOT NULL, roles TEXT NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN user_account.roles IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495591F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE terminal ADD CONSTRAINT FK_8F7B15411A5AC518 FOREIGN KEY (terminals) REFERENCES airport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E528716EC FOREIGN KEY (flights_arrival) REFERENCES airport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EF53666A8 FOREIGN KEY (plane_id) REFERENCES plane (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E897F2CF6 FOREIGN KEY (gate_id) REFERENCES gate (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight_crew ADD CONSTRAINT FK_8771DD591F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight_crew ADD CONSTRAINT FK_8771DD55FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bagage ADD CONSTRAINT FK_A82C5715B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gate ADD CONSTRAINT FK_B82B9894ECD4B3CE FOREIGN KEY (gates) REFERENCES terminal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE terminal DROP CONSTRAINT FK_8F7B15411A5AC518');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E528716EC');
        $this->addSql('ALTER TABLE flight_crew DROP CONSTRAINT FK_8771DD55FE259F6');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60EB83297E7');
        $this->addSql('ALTER TABLE bagage DROP CONSTRAINT FK_A82C5715B83297E7');
        $this->addSql('ALTER TABLE gate DROP CONSTRAINT FK_B82B9894ECD4B3CE');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60EF53666A8');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495591F478C5');
        $this->addSql('ALTER TABLE flight_crew DROP CONSTRAINT FK_8771DD591F478C5');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E979B1AD6');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E897F2CF6');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955A76ED395');
        $this->addSql('DROP SEQUENCE airport_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE crew_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE terminal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plane_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE flight_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bagage_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE price_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE company_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gate_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_account_id_seq CASCADE');
        $this->addSql('DROP TABLE airport');
        $this->addSql('DROP TABLE crew');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE terminal');
        $this->addSql('DROP TABLE plane');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE flight_crew');
        $this->addSql('DROP TABLE bagage');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE gate');
        $this->addSql('DROP TABLE user_account');
    }
}
