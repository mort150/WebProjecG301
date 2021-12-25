<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225095743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom_subject (classroom_id INT NOT NULL, subject_id INT NOT NULL, INDEX IDX_713FFF526278D5A8 (classroom_id), INDEX IDX_713FFF5223EDC87 (subject_id), PRIMARY KEY(classroom_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classroom_subject ADD CONSTRAINT FK_713FFF526278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classroom_subject ADD CONSTRAINT FK_713FFF5223EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classroom ADD teacher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classroom ADD CONSTRAINT FK_497D309D41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('CREATE INDEX IDX_497D309D41807E1D ON classroom (teacher_id)');
        $this->addSql('ALTER TABLE student ADD detail_id INT DEFAULT NULL, ADD classroom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33D8D003BB FOREIGN KEY (detail_id) REFERENCES student_detail (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF336278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33D8D003BB ON student (detail_id)');
        $this->addSql('CREATE INDEX IDX_B723AF336278D5A8 ON student (classroom_id)');
        $this->addSql('ALTER TABLE subject ADD subjectcategory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7AAAF5F5D8 FOREIGN KEY (subjectcategory_id) REFERENCES subject_category (id)');
        $this->addSql('CREATE INDEX IDX_FBCE3E7AAAF5F5D8 ON subject (subjectcategory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE classroom_subject');
        $this->addSql('ALTER TABLE classroom DROP FOREIGN KEY FK_497D309D41807E1D');
        $this->addSql('DROP INDEX IDX_497D309D41807E1D ON classroom');
        $this->addSql('ALTER TABLE classroom DROP teacher_id');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33D8D003BB');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF336278D5A8');
        $this->addSql('DROP INDEX UNIQ_B723AF33D8D003BB ON student');
        $this->addSql('DROP INDEX IDX_B723AF336278D5A8 ON student');
        $this->addSql('ALTER TABLE student DROP detail_id, DROP classroom_id');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7AAAF5F5D8');
        $this->addSql('DROP INDEX IDX_FBCE3E7AAAF5F5D8 ON subject');
        $this->addSql('ALTER TABLE subject DROP subjectcategory_id');
    }
}
