<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241022191507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player ADD equipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A656D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_98197A656D861B89 ON player (equipe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A656D861B89');
        $this->addSql('DROP INDEX IDX_98197A656D861B89 ON player');
        $this->addSql('ALTER TABLE player DROP equipe_id');
    }
}
