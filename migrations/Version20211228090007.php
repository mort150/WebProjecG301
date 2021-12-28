<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228090007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_detail ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student_detail ADD CONSTRAINT FK_A030A713CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A030A713CB944F1A ON student_detail (student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_detail DROP FOREIGN KEY FK_A030A713CB944F1A');
        $this->addSql('DROP INDEX UNIQ_A030A713CB944F1A ON student_detail');
        $this->addSql('ALTER TABLE student_detail DROP student_id');
    }
}
