<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201122174150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE user_car_favs (
                id int(10) unsigned NOT NULL AUTO_INCREMENT,
                user_name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                car_id varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                PRIMARY KEY (id)
            );
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('
            DROP TABLE user_car_favs
        ');
    }
}
