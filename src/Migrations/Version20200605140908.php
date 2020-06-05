<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200605140908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF38EDE692');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFF17C4D8C');
        $this->addSql('DROP INDEX IDX_3DDCB9FFF17C4D8C ON programme');
        $this->addSql('DROP INDEX IDX_3DDCB9FF38EDE692 ON programme');
        $this->addSql('ALTER TABLE programme ADD blocmodule_id INT DEFAULT NULL, ADD session_id INT DEFAULT NULL, DROP blocmodules_id, DROP sessions_id');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFFCB474AC FOREIGN KEY (blocmodule_id) REFERENCES blocmodule (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FFFCB474AC ON programme (blocmodule_id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FF613FECDF ON programme (session_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFFCB474AC');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF613FECDF');
        $this->addSql('DROP INDEX IDX_3DDCB9FFFCB474AC ON programme');
        $this->addSql('DROP INDEX IDX_3DDCB9FF613FECDF ON programme');
        $this->addSql('ALTER TABLE programme ADD blocmodules_id INT DEFAULT NULL, ADD sessions_id INT DEFAULT NULL, DROP blocmodule_id, DROP session_id');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF38EDE692 FOREIGN KEY (blocmodules_id) REFERENCES blocmodule (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFF17C4D8C FOREIGN KEY (sessions_id) REFERENCES session (id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FFF17C4D8C ON programme (sessions_id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FF38EDE692 ON programme (blocmodules_id)');
    }
}
