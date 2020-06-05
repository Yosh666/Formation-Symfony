<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200605114237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE programme_blocmodule');
        $this->addSql('DROP TABLE programme_session');
        $this->addSql('ALTER TABLE programme ADD blocmodules_id INT DEFAULT NULL, ADD sessions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF38EDE692 FOREIGN KEY (blocmodules_id) REFERENCES blocmodule (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFF17C4D8C FOREIGN KEY (sessions_id) REFERENCES session (id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FF38EDE692 ON programme (blocmodules_id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FFF17C4D8C ON programme (sessions_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE programme_blocmodule (programme_id INT NOT NULL, blocmodule_id INT NOT NULL, INDEX IDX_65D49ACF62BB7AEE (programme_id), INDEX IDX_65D49ACFFCB474AC (blocmodule_id), PRIMARY KEY(programme_id, blocmodule_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE programme_session (programme_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_BE7985F62BB7AEE (programme_id), INDEX IDX_BE7985F613FECDF (session_id), PRIMARY KEY(programme_id, session_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE programme_blocmodule ADD CONSTRAINT FK_65D49ACF62BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE programme_blocmodule ADD CONSTRAINT FK_65D49ACFFCB474AC FOREIGN KEY (blocmodule_id) REFERENCES blocmodule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE programme_session ADD CONSTRAINT FK_BE7985F613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE programme_session ADD CONSTRAINT FK_BE7985F62BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF38EDE692');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFF17C4D8C');
        $this->addSql('DROP INDEX IDX_3DDCB9FF38EDE692 ON programme');
        $this->addSql('DROP INDEX IDX_3DDCB9FFF17C4D8C ON programme');
        $this->addSql('ALTER TABLE programme DROP blocmodules_id, DROP sessions_id');
    }
}
