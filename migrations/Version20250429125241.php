<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250429125241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE reading (id INT AUTO_INCREMENT NOT NULL, electr_meter_id INT NOT NULL, value INT NOT NULL, date DATE NOT NULL, INDEX IDX_C11AFC4156C9DEBA (electr_meter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reading ADD CONSTRAINT FK_C11AFC4156C9DEBA FOREIGN KEY (electr_meter_id) REFERENCES electr_meter (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reading DROP FOREIGN KEY FK_C11AFC4156C9DEBA
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reading
        SQL);
    }
}
