<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513173057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, posseseur_id INT NOT NULL, salle_id INT NOT NULL, datereservation DATETIME NOT NULL, duree VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_42C849553C5505E4 (posseseur_id), INDEX IDX_42C84955DC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources (id INT AUTO_INCREMENT NOT NULL, posseseur_id INT NOT NULL, salle_id INT NOT NULL, typesressource VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, quantite VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, datecreation DATETIME NOT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_6A2CD5C73C5505E4 (posseseur_id), INDEX IDX_6A2CD5C7DC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salles (id INT AUTO_INCREMENT NOT NULL, posseseur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_799D45AA3C5505E4 (posseseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numerotelephone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849553C5505E4 FOREIGN KEY (posseseur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955DC304035 FOREIGN KEY (salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE ressources ADD CONSTRAINT FK_6A2CD5C73C5505E4 FOREIGN KEY (posseseur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ressources ADD CONSTRAINT FK_6A2CD5C7DC304035 FOREIGN KEY (salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AA3C5505E4 FOREIGN KEY (posseseur_id) REFERENCES salles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955DC304035');
        $this->addSql('ALTER TABLE ressources DROP FOREIGN KEY FK_6A2CD5C7DC304035');
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AA3C5505E4');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849553C5505E4');
        $this->addSql('ALTER TABLE ressources DROP FOREIGN KEY FK_6A2CD5C73C5505E4');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE ressources');
        $this->addSql('DROP TABLE salles');
        $this->addSql('DROP TABLE user');
    }
}
