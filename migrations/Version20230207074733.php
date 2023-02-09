<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207074733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juego ADD nombre VARCHAR(255) NOT NULL, ADD editorial VARCHAR(50) NOT NULL, ADD minimo DOUBLE PRECISION NOT NULL, ADD maximo DOUBLE PRECISION NOT NULL, ADD ancho DOUBLE PRECISION NOT NULL, ADD alto DOUBLE PRECISION NOT NULL, ADD imagen VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juego DROP nombre, DROP editorial, DROP minimo, DROP maximo, DROP ancho, DROP alto, DROP imagen');
    }
}
