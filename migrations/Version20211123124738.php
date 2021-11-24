<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123124738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, rue VARCHAR(30) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnes ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnes ADD CONSTRAINT FK_2BB4FE2B4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2BB4FE2B4DE7DC5C ON personnes (adresse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnes DROP FOREIGN KEY FK_2BB4FE2B4DE7DC5C');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP INDEX UNIQ_2BB4FE2B4DE7DC5C ON personnes');
        $this->addSql('ALTER TABLE personnes DROP adresse_id');
    }
}
