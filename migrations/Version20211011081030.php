<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011081030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(50) NOT NULL, poids INT NOT NULL, couleur VARCHAR(10) NOT NULL, camp VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, terrain_j1 LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', terrain_j2 LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', des LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', date_debut DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, gagnant VARCHAR(2) DEFAULT NULL, qui_le_tour INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE carte');
        $this->addSql('DROP TABLE partie');
    }
}
