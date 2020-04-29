<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428131434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE exception_date (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, promotion_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, start DATE NOT NULL, "end" DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_AD46FD63139DF194 ON exception_date (promotion_id)');
        $this->addSql('CREATE TABLE presence (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , date DATETIME NOT NULL, signature CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6977C7A5A76ED395 ON presence (user_id)');
        $this->addSql('CREATE TABLE promotion (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, start DATE NOT NULL, "end" DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE promotion_regroupement (promotion_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , regroupement_id INTEGER NOT NULL, PRIMARY KEY(promotion_id, regroupement_id))');
        $this->addSql('CREATE INDEX IDX_DFB3BF59139DF194 ON promotion_regroupement (promotion_id)');
        $this->addSql('CREATE INDEX IDX_DFB3BF5998655AD2 ON promotion_regroupement (regroupement_id)');
        $this->addSql('CREATE TABLE regroupement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE user_promotion (user_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , promotion_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , PRIMARY KEY(user_id, promotion_id))');
        $this->addSql('CREATE INDEX IDX_C1FDF035A76ED395 ON user_promotion (user_id)');
        $this->addSql('CREATE INDEX IDX_C1FDF035139DF194 ON user_promotion (promotion_id)');
        $this->addSql('CREATE TABLE user_regroupement (user_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , regroupement_id INTEGER NOT NULL, PRIMARY KEY(user_id, regroupement_id))');
        $this->addSql('CREATE INDEX IDX_39A80658A76ED395 ON user_regroupement (user_id)');
        $this->addSql('CREATE INDEX IDX_39A8065898655AD2 ON user_regroupement (regroupement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE exception_date');
        $this->addSql('DROP TABLE presence');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE promotion_regroupement');
        $this->addSql('DROP TABLE regroupement');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_promotion');
        $this->addSql('DROP TABLE user_regroupement');
    }
}
