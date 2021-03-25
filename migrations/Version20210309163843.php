<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309163843 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) DEFAULT NULL, fecha_nacimiento DATE NOT NULL, domicilio VARCHAR(255) NOT NULL, telefono INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, cliente_id INT NOT NULL, vuelo_id INT NOT NULL, fecha DATE NOT NULL, INDEX IDX_188D2E3BDE734E51 (cliente_id), INDEX IDX_188D2E3B4FF34720 (vuelo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vuelo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, aerolinea VARCHAR(255) NOT NULL, ciudad_salida VARCHAR(255) NOT NULL, ciudad_llegada VARCHAR(255) NOT NULL, fecha_salida DATE NOT NULL, fecha_llegada DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B4FF34720 FOREIGN KEY (vuelo_id) REFERENCES vuelo (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BDE734E51');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B4FF34720');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE vuelo');
    }
}
