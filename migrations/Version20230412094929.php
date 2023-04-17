<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230412094929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('fruits');
        $table->addColumn('id', 'integer', [
            'autoincrement' => true,
        ]);
        $table->setPrimaryKey(array('id'));

        $table->addColumn('fruit_id', 'integer');

        $table->addColumn('genus', 'string');
        $table->addColumn('family', 'string');
        $table->addColumn('name', 'string');
        $table->addColumn('f_order', 'string');

        $table->addColumn('carbohydrates', 'float');
        $table->addColumn('protein', 'float');
        $table->addColumn('fat', 'float');
        $table->addColumn('calories', 'float');
        $table->addColumn('sugar', 'float');
        $table->addColumn('is_favorite', 'boolean', [
            'default' => 0
        ]);

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}
