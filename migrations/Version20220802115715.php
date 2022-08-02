<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220802115715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chantier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, starts_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pointages (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, chantier_id INT NOT NULL, date DATE NOT NULL, starts_at TIME NOT NULL, ends_at TIME NOT NULL, INDEX IDX_2067B6D8A76ED395 (user_id), UNIQUE INDEX UNIQ_2067B6D8D0C0049D (chantier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D64912B2DC9C (matricule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pointages ADD CONSTRAINT FK_2067B6D8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pointages ADD CONSTRAINT FK_2067B6D8D0C0049D FOREIGN KEY (chantier_id) REFERENCES chantier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointages DROP FOREIGN KEY FK_2067B6D8D0C0049D');
        $this->addSql('ALTER TABLE pointages DROP FOREIGN KEY FK_2067B6D8A76ED395');
        $this->addSql('DROP TABLE chantier');
        $this->addSql('DROP TABLE pointages');
        $this->addSql('DROP TABLE user');
    }
}
