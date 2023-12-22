<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231110095414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD un_hackathon_id INT NOT NULL, ADD un_utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6690C098D FOREIGN KEY (un_hackathon_id) REFERENCES hackathon (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6B0141749 FOREIGN KEY (un_utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6690C098D ON inscription (un_hackathon_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6B0141749 ON inscription (un_utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6690C098D');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6B0141749');
        $this->addSql('DROP INDEX IDX_5E90F6D6690C098D ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D6B0141749 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP un_hackathon_id, DROP un_utilisateur_id');
    }
}
