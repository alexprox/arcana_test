USE sparrow;

CREATE TABLE follow (
  followed_id int(10) UNSIGNED NOT NULL,
  follower_id int(10) UNSIGNED NOT NULL,
  UNIQUE INDEX UK_follow (followed_id, follower_id)
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'follow';

CREATE TABLE users (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  fullname varbinary(64) NOT NULL,
  username varbinary(32) NOT NULL,
  pass varbinary(60) NOT NULL,
  updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE tweets (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  text varbinary(160) DEFAULT NULL,
  author_id int(10) UNSIGNED NOT NULL,
  retweet_id int(10) UNSIGNED DEFAULT NULL,
  tweet_id int(10) UNSIGNED DEFAULT NULL,
  updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT FK_tweets_retweets_id FOREIGN KEY (retweet_id)
  REFERENCES tweets (id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FK_tweets_tweets_id FOREIGN KEY (tweet_id)
  REFERENCES tweets (id) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FK_tweets_users_id FOREIGN KEY (author_id)
  REFERENCES users (id) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

DELIMITER $$

CREATE
DEFINER = 'root'@'localhost'
TRIGGER delete_follow_connections
AFTER DELETE
ON users
FOR EACH ROW
BEGIN
  DELETE
    FROM sparrow.follow
  WHERE OLD.id IN (followed_id, follower_id);
END
$$

DELIMITER ;