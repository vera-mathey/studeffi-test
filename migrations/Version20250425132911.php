<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250425132911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE electr_meter ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE electr_meter ADD CONSTRAINT FK_F5DCB424A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F5DCB424A76ED395 ON electr_meter (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE electr_meter DROP FOREIGN KEY FK_F5DCB424A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F5DCB424A76ED395 ON electr_meter
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE electr_meter DROP user_id
        SQL);
    }
}
