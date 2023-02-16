<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215124505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ejemplo_usuario (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D88DDFA7E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE juego (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, editorial VARCHAR(50) NOT NULL, minimo DOUBLE PRECISION NOT NULL, maximo DOUBLE PRECISION NOT NULL, ancho DOUBLE PRECISION NOT NULL, alto DOUBLE PRECISION NOT NULL, imagen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mesa (id INT AUTO_INCREMENT NOT NULL, ancho DOUBLE PRECISION NOT NULL, alto DOUBLE PRECISION NOT NULL, x DOUBLE PRECISION DEFAULT NULL, y DOUBLE PRECISION DEFAULT NULL, imagen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, tipo VARCHAR(255) NOT NULL, cantidad INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prueba (id INT AUTO_INCREMENT NOT NULL, pepe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, fechahora DATETIME NOT NULL, fechacancelación DATETIME DEFAULT NULL, presentado TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tramo (id INT AUTO_INCREMENT NOT NULL, asiste TINYINT(1) NOT NULL, fechainicio DATETIME NOT NULL, fechafin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, password VARCHAR(18) NOT NULL, apellido1 VARCHAR(40) NOT NULL, apellido2 VARCHAR(40) NOT NULL, correo VARCHAR(60) NOT NULL, nickname VARCHAR(50) NOT NULL, rol VARCHAR(20) NOT NULL, num_telegram INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D011858652E');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D019EFB0C1D');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01F6F50196');
        $this->addSql('DROP TABLE banda');
        $this->addSql('DROP TABLE mensaje');
        $this->addSql('DROP TABLE modo');
        $this->addSql('DROP TABLE participante');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE banda (id INT AUTO_INCREMENT NOT NULL, maximo DOUBLE PRECISION NOT NULL, minimo DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mensaje (id INT AUTO_INCREMENT NOT NULL, participante_id INT NOT NULL, modo_id INT NOT NULL, banda_id INT NOT NULL, fecha DATE NOT NULL, validado TINYINT(1) NOT NULL, id_juezz VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_9B631D01F6F50196 (participante_id), INDEX IDX_9B631D011858652E (modo_id), INDEX IDX_9B631D019EFB0C1D (banda_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE modo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, descripcion VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participante (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_85BDC5C33A909126 (nombre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D011858652E FOREIGN KEY (modo_id) REFERENCES modo (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D019EFB0C1D FOREIGN KEY (banda_id) REFERENCES banda (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01F6F50196 FOREIGN KEY (participante_id) REFERENCES participante (id)');
        $this->addSql('DROP TABLE ejemplo_usuario');
        $this->addSql('DROP TABLE juego');
        $this->addSql('DROP TABLE mesa');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE prueba');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE tramo');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE usuario');
    }
}
