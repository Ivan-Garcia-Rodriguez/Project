<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119074535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumno_examen (alumno_id INT NOT NULL, examen_id INT NOT NULL, INDEX IDX_F25C4A91FC28E5EE (alumno_id), INDEX IDX_F25C4A915C8659A (examen_id), PRIMARY KEY(alumno_id, examen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumno_examen ADD CONSTRAINT FK_F25C4A91FC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumno (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alumno_examen ADD CONSTRAINT FK_F25C4A915C8659A FOREIGN KEY (examen_id) REFERENCES examen (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumno_examen DROP FOREIGN KEY FK_F25C4A91FC28E5EE');
        $this->addSql('ALTER TABLE alumno_examen DROP FOREIGN KEY FK_F25C4A915C8659A');
        $this->addSql('DROP TABLE alumno_examen');
    }
}
