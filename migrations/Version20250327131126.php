<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20250327131126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
       
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_category (media_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_92D3773EA9FDD75 (media_id), INDEX IDX_92D377312469DE2 (category_id), PRIMARY KEY(media_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upload (id INT AUTO_INCREMENT NOT NULL, uploaded_by_id INT NOT NULL, uploaded_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', url VARCHAR(255) NOT NULL, INDEX IDX_17BDE61FA2B28FE8 (uploaded_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media_category ADD CONSTRAINT FK_92D3773EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_category ADD CONSTRAINT FK_92D377312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE upload ADD CONSTRAINT FK_17BDE61FA2B28FE8 FOREIGN KEY (uploaded_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE media_categorie DROP FOREIGN KEY FK_6C1D65BAEA9FDD75');
        $this->addSql('ALTER TABLE media_categorie DROP FOREIGN KEY FK_6C1D65BABCF5E72D');
        $this->addSql('DROP TABLE media_categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C1CB68378');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9D86650F');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C605D5AE6');
        $this->addSql('DROP INDEX IDX_9474526C9D86650F ON comment');
        $this->addSql('DROP INDEX UNIQ_9474526C605D5AE6 ON comment');
        $this->addSql('DROP INDEX IDX_9474526C1CB68378 ON comment');
        $this->addSql('ALTER TABLE comment ADD publisher_id INT NOT NULL, ADD media_id INT NOT NULL, DROP user_id_id, DROP media_id_id, CHANGE child_comment_id parent_comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CBF2AF943 FOREIGN KEY (parent_comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C40C86FCE FOREIGN KEY (publisher_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_9474526CBF2AF943 ON comment (parent_comment_id)');
        $this->addSql('CREATE INDEX IDX_9474526C40C86FCE ON comment (publisher_id)');
        $this->addSql('CREATE INDEX IDX_9474526CEA9FDD75 ON comment (media_id)');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA68756988');
        $this->addSql('DROP INDEX UNIQ_DDAA1CDA68756988 ON episode');
        $this->addSql('ALTER TABLE episode ADD released_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP release_date, CHANGE duration duration INT NOT NULL, CHANGE season_id_id season_id INT NOT NULL');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('CREATE INDEX IDX_DDAA1CDA4EC001D1 ON episode (season_id)');
        $this->addSql('ALTER TABLE language ADD nom VARCHAR(255) NOT NULL, DROP name, CHANGE code code VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C4D8CCBCC');
        $this->addSql('DROP INDEX IDX_6A2CA10C4D8CCBCC ON media');
        $this->addSql('ALTER TABLE media ADD casting JSON NOT NULL, DROP watch_history_id, DROP caste, CHANGE short_description short_description LONGTEXT NOT NULL, CHANGE long_description long_description LONGTEXT NOT NULL, CHANGE release_date release_date DATETIME NOT NULL, CHANGE cover_image cover_image VARCHAR(255) NOT NULL, CHANGE staff staff JSON NOT NULL, CHANGE media_type mediaType VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE playlist ADD creator_id INT NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_D782112D61220EA6 ON playlist (creator_id)');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84FDC588714');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84F605D5AE6');
        $this->addSql('DROP INDEX IDX_C930B84FDC588714 ON playlist_media');
        $this->addSql('DROP INDEX IDX_C930B84F605D5AE6 ON playlist_media');
        $this->addSql('ALTER TABLE playlist_media ADD playlist_id INT NOT NULL, ADD media_id INT NOT NULL, DROP playlist_id_id, DROP media_id_id, CHANGE added_at added_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84F6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84FEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_C930B84F6BBD148 ON playlist_media (playlist_id)');
        $this->addSql('CREATE INDEX IDX_C930B84FEA9FDD75 ON playlist_media (media_id)');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940CDC588714');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C9D86650F');
        $this->addSql('DROP INDEX IDX_832940C9D86650F ON playlist_subscription');
        $this->addSql('DROP INDEX IDX_832940CDC588714 ON playlist_subscription');
        $this->addSql('ALTER TABLE playlist_subscription ADD playlist_id INT NOT NULL, ADD subscriber_id INT NOT NULL, DROP user_id_id, DROP playlist_id_id, CHANGE subscribed_at subscribed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C7808B1AD FOREIGN KEY (subscriber_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_832940C6BBD148 ON playlist_subscription (playlist_id)');
        $this->addSql('CREATE INDEX IDX_832940C7808B1AD ON playlist_subscription (subscriber_id)');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9B748AAC3');
        $this->addSql('DROP INDEX IDX_F0E45BA9B748AAC3 ON season');
        $this->addSql('ALTER TABLE season ADD serie_id INT NOT NULL, ADD number VARCHAR(255) NOT NULL, DROP serie_id_id, DROP season_number');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('CREATE INDEX IDX_F0E45BA9D94388BD ON season (serie_id)');
        $this->addSql('ALTER TABLE subscription CHANGE name name VARCHAR(255) NOT NULL, CHANGE price price INT NOT NULL, CHANGE duration_in_months duration INT NOT NULL');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D09D86650F');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D0857C9F24');
        $this->addSql('DROP INDEX UNIQ_54AF90D09D86650F ON subscription_history');
        $this->addSql('DROP INDEX IDX_54AF90D0857C9F24 ON subscription_history');
        $this->addSql('ALTER TABLE subscription_history ADD subscription_id INT NOT NULL, ADD start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP subscription_id_id, DROP start_date, DROP end_date, CHANGE user_id_id subscriber_id INT NOT NULL');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D07808B1AD FOREIGN KEY (subscriber_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D09A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('CREATE INDEX IDX_54AF90D07808B1AD ON subscription_history (subscriber_id)');
        $this->addSql('CREATE INDEX IDX_54AF90D09A1887DC ON subscription_history (subscription_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496BBD148');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494924D8AF');
        $this->addSql('DROP INDEX UNIQ_8D93D6494924D8AF ON user');
        $this->addSql('DROP INDEX IDX_8D93D6496BBD148 ON user');
        $this->addSql('ALTER TABLE user ADD profile_picture VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL, DROP current_subscription_id_id, CHANGE username username VARCHAR(255) NOT NULL, CHANGE playlist_id current_subscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DDE45DDE FOREIGN KEY (current_subscription_id) REFERENCES subscription (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DDE45DDE ON user (current_subscription_id)');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD89D86650F');
        $this->addSql('DROP INDEX UNIQ_DE44EFD89D86650F ON watch_history');
        $this->addSql('ALTER TABLE watch_history ADD media_id INT NOT NULL, ADD last_watched_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD number_of_views INT NOT NULL, DROP user_id_id, DROP last_watched, CHANGE number_of_view watcher_id INT NOT NULL');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8C300AB5D FOREIGN KEY (watcher_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_DE44EFD8C300AB5D ON watch_history (watcher_id)');
        $this->addSql('CREATE INDEX IDX_DE44EFD8EA9FDD75 ON watch_history (media_id)');
    }

    public function down(Schema $schema): void
    {
        
        $this->addSql('CREATE TABLE media_categorie (media_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_6C1D65BAEA9FDD75 (media_id), INDEX IDX_6C1D65BABCF5E72D (categorie_id), PRIMARY KEY(media_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE media_categorie ADD CONSTRAINT FK_6C1D65BAEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_categorie ADD CONSTRAINT FK_6C1D65BABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_category DROP FOREIGN KEY FK_92D3773EA9FDD75');
        $this->addSql('ALTER TABLE media_category DROP FOREIGN KEY FK_92D377312469DE2');
        $this->addSql('ALTER TABLE upload DROP FOREIGN KEY FK_17BDE61FA2B28FE8');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE media_category');
        $this->addSql('DROP TABLE upload');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D07808B1AD');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D09A1887DC');
        $this->addSql('DROP INDEX IDX_54AF90D07808B1AD ON subscription_history');
        $this->addSql('DROP INDEX IDX_54AF90D09A1887DC ON subscription_history');
        $this->addSql('ALTER TABLE subscription_history ADD user_id_id INT NOT NULL, ADD subscription_id_id INT DEFAULT NULL, ADD start_date DATE NOT NULL, ADD end_date DATE NOT NULL, DROP subscriber_id, DROP subscription_id, DROP start_at, DROP end_at');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D09D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D0857C9F24 FOREIGN KEY (subscription_id_id) REFERENCES subscription (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54AF90D09D86650F ON subscription_history (user_id_id)');
        $this->addSql('CREATE INDEX IDX_54AF90D0857C9F24 ON subscription_history (subscription_id_id)');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649DDE45DDE');
        $this->addSql('DROP INDEX IDX_8D93D649DDE45DDE ON `user`');
        $this->addSql('ALTER TABLE `user` ADD current_subscription_id_id INT NOT NULL, DROP profile_picture, DROP roles, CHANGE username username VARCHAR(100) NOT NULL, CHANGE current_subscription_id playlist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6496BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6494924D8AF FOREIGN KEY (current_subscription_id_id) REFERENCES subscription (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494924D8AF ON `user` (current_subscription_id_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496BBD148 ON `user` (playlist_id)');
        $this->addSql('ALTER TABLE media ADD watch_history_id INT DEFAULT NULL, ADD caste JSON DEFAULT NULL, DROP casting, CHANGE short_description short_description LONGTEXT DEFAULT NULL, CHANGE long_description long_description LONGTEXT DEFAULT NULL, CHANGE release_date release_date DATE DEFAULT NULL, CHANGE cover_image cover_image VARCHAR(255) DEFAULT NULL, CHANGE staff staff JSON DEFAULT NULL, CHANGE mediaType media_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4D8CCBCC FOREIGN KEY (watch_history_id) REFERENCES watch_history (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4D8CCBCC ON media (watch_history_id)');
        $this->addSql('ALTER TABLE language ADD name VARCHAR(100) NOT NULL, DROP nom, CHANGE code code VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE subscription CHANGE name name VARCHAR(100) NOT NULL, CHANGE price price NUMERIC(10, 2) NOT NULL, CHANGE duration duration_in_months INT NOT NULL');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8C300AB5D');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8EA9FDD75');
        $this->addSql('DROP INDEX IDX_DE44EFD8C300AB5D ON watch_history');
        $this->addSql('DROP INDEX IDX_DE44EFD8EA9FDD75 ON watch_history');
        $this->addSql('ALTER TABLE watch_history ADD user_id_id INT DEFAULT NULL, ADD last_watched DATETIME NOT NULL, ADD number_of_view INT NOT NULL, DROP watcher_id, DROP media_id, DROP last_watched_at, DROP number_of_views');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE44EFD89D86650F ON watch_history (user_id_id)');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D61220EA6');
        $this->addSql('DROP INDEX IDX_D782112D61220EA6 ON playlist');
        $this->addSql('ALTER TABLE playlist DROP creator_id, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA4EC001D1');
        $this->addSql('DROP INDEX IDX_DDAA1CDA4EC001D1 ON episode');
        $this->addSql('ALTER TABLE episode ADD release_date DATE DEFAULT NULL, DROP released_at, CHANGE duration duration TIME DEFAULT NULL, CHANGE season_id season_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA68756988 FOREIGN KEY (season_id_id) REFERENCES season (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDAA1CDA68756988 ON episode (season_id_id)');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84F6BBD148');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84FEA9FDD75');
        $this->addSql('DROP INDEX IDX_C930B84F6BBD148 ON playlist_media');
        $this->addSql('DROP INDEX IDX_C930B84FEA9FDD75 ON playlist_media');
        $this->addSql('ALTER TABLE playlist_media ADD playlist_id_id INT DEFAULT NULL, ADD media_id_id INT DEFAULT NULL, DROP playlist_id, DROP media_id, CHANGE added_at added_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84FDC588714 FOREIGN KEY (playlist_id_id) REFERENCES playlist (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84F605D5AE6 FOREIGN KEY (media_id_id) REFERENCES media (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C930B84FDC588714 ON playlist_media (playlist_id_id)');
        $this->addSql('CREATE INDEX IDX_C930B84F605D5AE6 ON playlist_media (media_id_id)');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C6BBD148');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C7808B1AD');
        $this->addSql('DROP INDEX IDX_832940C6BBD148 ON playlist_subscription');
        $this->addSql('DROP INDEX IDX_832940C7808B1AD ON playlist_subscription');
        $this->addSql('ALTER TABLE playlist_subscription ADD user_id_id INT DEFAULT NULL, ADD playlist_id_id INT DEFAULT NULL, DROP playlist_id, DROP subscriber_id, CHANGE subscribed_at subscribed_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940CDC588714 FOREIGN KEY (playlist_id_id) REFERENCES playlist (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_832940C9D86650F ON playlist_subscription (user_id_id)');
        $this->addSql('CREATE INDEX IDX_832940CDC588714 ON playlist_subscription (playlist_id_id)');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBF2AF943');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C40C86FCE');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CEA9FDD75');
        $this->addSql('DROP INDEX IDX_9474526CBF2AF943 ON comment');
        $this->addSql('DROP INDEX IDX_9474526C40C86FCE ON comment');
        $this->addSql('DROP INDEX IDX_9474526CEA9FDD75 ON comment');
        $this->addSql('ALTER TABLE comment ADD user_id_id INT NOT NULL, ADD media_id_id INT NOT NULL, DROP publisher_id, DROP media_id, CHANGE parent_comment_id child_comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C1CB68378 FOREIGN KEY (child_comment_id) REFERENCES comment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C605D5AE6 FOREIGN KEY (media_id_id) REFERENCES media (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9474526C9D86650F ON comment (user_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9474526C605D5AE6 ON comment (media_id_id)');
        $this->addSql('CREATE INDEX IDX_9474526C1CB68378 ON comment (child_comment_id)');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9D94388BD');
        $this->addSql('DROP INDEX IDX_F0E45BA9D94388BD ON season');
        $this->addSql('ALTER TABLE season ADD season_number INT NOT NULL, DROP number, CHANGE serie_id serie_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9B748AAC3 FOREIGN KEY (serie_id_id) REFERENCES serie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F0E45BA9B748AAC3 ON season (serie_id_id)');
    }
}
