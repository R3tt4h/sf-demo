<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210124125339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE books_books');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE books_books (books_source INT NOT NULL, books_target INT NOT NULL, INDEX IDX_E1E99E6B9B40C77F (books_source), INDEX IDX_E1E99E6B82A597F0 (books_target), PRIMARY KEY(books_source, books_target)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE books_books ADD CONSTRAINT FK_E1E99E6B82A597F0 FOREIGN KEY (books_target) REFERENCES books (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_books ADD CONSTRAINT FK_E1E99E6B9B40C77F FOREIGN KEY (books_source) REFERENCES books (id) ON DELETE CASCADE');
    }
}
