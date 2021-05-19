<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325094944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, cuu_password VARCHAR(211) NOT NULL, cuu_name VARCHAR(211) NOT NULL, cuu_email VARCHAR(211) NOT NULL, cuu_securitytoken VARCHAR(255) NOT NULL, cuu_heure VARCHAR(8) NOT NULL, cuu_jour INT NOT NULL, cuu_epice DOUBLE PRECISION NOT NULL, cuu_impot DOUBLE PRECISION NOT NULL, cuu_soin DOUBLE PRECISION NOT NULL, cuu_serviteur DOUBLE PRECISION NOT NULL, cuu_influence DOUBLE PRECISION NOT NULL, cuu_gardien DOUBLE PRECISION NOT NULL, cuu_vaisseau INT NOT NULL, cuu_troupe INT NOT NULL, cuu_corruption INT NOT NULL, cuu_entretien VARCHAR(121) NOT NULL, cuu_salle INT NOT NULL, cuu_renommee INT NOT NULL, cuu_delai_attentat INT NOT NULL, cuu_nb_victime INT NOT NULL, cuu_valeur_serviteur INT NOT NULL, cuu_valeur_troupe INT NOT NULL, cuu_valeur_vaisseau INT NOT NULL, cuu_entrainement INT NOT NULL, cuu_exploration INT NOT NULL, cuu_objets TEXT NOT NULL, cuu_rapport_planete TEXT NOT NULL, cuu_connexion TEXT NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
    }
}
