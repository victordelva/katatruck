<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201121202725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE cars (
                id int(10) unsigned NOT NULL AUTO_INCREMENT,
                brand varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                model varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                price_amount int(11) NOT NULL,
                price_currency varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                PRIMARY KEY (id)
            );
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('
            DROP TABLE cars
        ');
    }
}
