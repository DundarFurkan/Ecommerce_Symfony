<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190113164634 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, subject VARCHAR(100) DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, comment VARCHAR(100) DEFAULT NULL, status VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category CHANGE parentid parentid INT NOT NULL, CHANGE title title VARCHAR(30) NOT NULL, CHANGE keywords keywords VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE setting CHANGE title title VARCHAR(100) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE keywords keywords VARCHAR(255) NOT NULL, CHANGE company company VARCHAR(255) NOT NULL, CHANGE address address VARCHAR(255) NOT NULL, CHANGE fax fax VARCHAR(255) NOT NULL, CHANGE phone phone VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE smtpserver smtpserver VARCHAR(255) NOT NULL, CHANGE smtpemail smtpemail VARCHAR(255) NOT NULL, CHANGE smptppass smptppass VARCHAR(255) NOT NULL, CHANGE smtpport smtpport VARCHAR(255) NOT NULL, CHANGE aboutus aboutus VARCHAR(255) NOT NULL, CHANGE contact contact VARCHAR(255) NOT NULL, CHANGE referances referances VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE messages');
        $this->addSql('ALTER TABLE category CHANGE parentid parentid INT DEFAULT NULL, CHANGE title title VARCHAR(30) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE keywords keywords VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE setting CHANGE title title VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE keywords keywords VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE company company VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE address address VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE fax fax VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE phone phone VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE smtpserver smtpserver VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE smtpemail smtpemail VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE smptppass smptppass VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE smtpport smtpport INT DEFAULT NULL, CHANGE aboutus aboutus LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE contact contact LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE referances referances LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
