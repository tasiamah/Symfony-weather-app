<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200510172127 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE precipitation (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, date VARCHAR(50) NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_FBC9E24421BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stations (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, latitude VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temperature (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, date VARCHAR(50) NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_BE4E2A6C21BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE precipitation ADD CONSTRAINT FK_FBC9E24421BDB235 FOREIGN KEY (station_id) REFERENCES stations (id)');
        $this->addSql('ALTER TABLE temperature ADD CONSTRAINT FK_BE4E2A6C21BDB235 FOREIGN KEY (station_id) REFERENCES stations (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE precipitation DROP FOREIGN KEY FK_FBC9E24421BDB235');
        $this->addSql('ALTER TABLE temperature DROP FOREIGN KEY FK_BE4E2A6C21BDB235');
        $this->addSql('DROP TABLE precipitation');
        $this->addSql('DROP TABLE stations');
        $this->addSql('DROP TABLE temperature');
    }
}
