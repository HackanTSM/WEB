<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231110103556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6690C098D');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6B0141749');
        $this->addSql('DROP INDEX IDX_5E90F6D6690C098D ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D6B0141749 ON inscription');
        $this->addSql('ALTER TABLE inscription ADD id_hackathon INT NOT NULL, ADD id_utilisateur INT NOT NULL, DROP un_hackathon_id, DROP un_utilisateur_id');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6B0F4A68 FOREIGN KEY (id_hackathon) REFERENCES hackathon (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D650EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6B0F4A68 ON inscription (id_hackathon)');
        $this->addSql('CREATE INDEX IDX_5E90F6D650EAE44 ON inscription (id_utilisateur)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6B0F4A68');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D650EAE44');
        $this->addSql('DROP INDEX IDX_5E90F6D6B0F4A68 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D650EAE44 ON inscription');
        $this->addSql('ALTER TABLE inscription ADD un_hackathon_id INT NOT NULL, ADD un_utilisateur_id INT NOT NULL, DROP id_hackathon, DROP id_utilisateur');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6690C098D FOREIGN KEY (un_hackathon_id) REFERENCES hackathon (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6B0141749 FOREIGN KEY (un_utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6690C098D ON inscription (un_hackathon_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6B0141749 ON inscription (un_utilisateur_id)');
    }
}
