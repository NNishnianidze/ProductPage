<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221031194941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Products (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, product_type VARCHAR(255) NOT NULL, price NUMERIC(13, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, product VARCHAR(255) NOT NULL, size INT DEFAULT NULL, weight NUMERIC(13, 3) DEFAULT NULL, height NUMERIC(13, 3) DEFAULT NULL, width NUMERIC(13, 3) DEFAULT NULL, length NUMERIC(13, 3) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Products');
    }
}
