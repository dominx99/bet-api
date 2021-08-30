<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210830163456 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE bet (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bet_user (user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', bet_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_A8450575A76ED395 (user_id), INDEX IDX_A8450575D871DC26 (bet_id), PRIMARY KEY(user_id, bet_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bet_user ADD CONSTRAINT FK_A8450575A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bet_user ADD CONSTRAINT FK_A8450575D871DC26 FOREIGN KEY (bet_id) REFERENCES bet (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE bet_user DROP FOREIGN KEY FK_A8450575D871DC26');
        $this->addSql('DROP TABLE bet');
        $this->addSql('DROP TABLE bet_user');
    }
}
