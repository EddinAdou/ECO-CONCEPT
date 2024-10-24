<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024130438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE analyze_url (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, poids_total DOUBLE PRECISION NOT NULL, nb_requetes INT NOT NULL, empreinte_carbone DOUBLE PRECISION NOT NULL, empreinte_eau DOUBLE PRECISION NOT NULL, date_analyse DATETIME NOT NULL, score DOUBLE PRECISION NOT NULL, optimiser_images TINYINT(1) NOT NULL, reduire_requettes TINYINT(1) NOT NULL, note VARCHAR(1) NOT NULL, appreciation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE `analyze`');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `analyze` (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, poids_total DOUBLE PRECISION NOT NULL, nb_requetes INT NOT NULL, empreinte_carbone DOUBLE PRECISION NOT NULL, empreinte_eau DOUBLE PRECISION NOT NULL, date_analyse DATETIME NOT NULL, score DOUBLE PRECISION NOT NULL, optimiser_images TINYINT(1) NOT NULL, reduire_requettes TINYINT(1) NOT NULL, note VARCHAR(1) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, appreciation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE analyze_url');
    }
}
