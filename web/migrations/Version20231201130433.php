<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201130433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY fk_evenement_participant');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY fk_evenement_hackathon');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY fk_evenement_theme');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY fk_evenement_intervenant');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE theme');
        $this->addSql('ALTER TABLE hackathon ADD description VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD rue VARCHAR(255) NOT NULL, ADD cp VARCHAR(5) NOT NULL, ADD image VARCHAR(255) NOT NULL, ADD date_fin DATETIME NOT NULL, ADD date_debut DATETIME NOT NULL');
        $this->addSql('ALTER TABLE utilisateurs CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervenant (id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE evenement (id INT NOT NULL, id_intervenant INT DEFAULT NULL, id_theme INT DEFAULT NULL, id_participant INT DEFAULT NULL, id_hackathon INT DEFAULT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, date DATE DEFAULT NULL, heure TIME DEFAULT NULL, duree INT DEFAULT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, nbPlaces INT DEFAULT NULL, INDEX fk_evenement_theme (id_theme), INDEX fk_evenement_participant (id_participant), INDEX fk_evenement_hackathon (id_hackathon), INDEX fk_evenement_intervenant (id_intervenant), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participant (id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE theme (id INT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT fk_evenement_participant FOREIGN KEY (id_participant) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT fk_evenement_hackathon FOREIGN KEY (id_hackathon) REFERENCES hackathon (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT fk_evenement_theme FOREIGN KEY (id_theme) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT fk_evenement_intervenant FOREIGN KEY (id_intervenant) REFERENCES intervenant (id)');
        $this->addSql('ALTER TABLE hackathon DROP description, DROP ville, DROP rue, DROP cp, DROP image, DROP date_fin, DROP date_debut');
        $this->addSql('ALTER TABLE utilisateurs CHANGE roles roles JSON DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    }
}
