-- -----------------------------------------------------
-- table `project` 
-- -----------------------------------------------------
USE medt3;

DROP TABLE IF EXISTS project;

CREATE TABLE project (
	id INTEGER NOT NULL auto_increment,
	name varchar(255) NOT NULL,
	description text,
	createDate DATETIME NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO project (name, description, createDate) VALUES 
	('Demo App A','Some text','2014-02-10 12:00:00'),
	('Demo App B','Some text text','2014-02-10 12:01:00'),
	('Demo App C','Some text text text','2014-02-10 12:02:00'),
	('Demo App D','Some text text text text','2014-02-07 12:02:00'),
	('Demo App E','Some text text text text text','2014-02-09 11:02:00'),
	('Demo App F','Some text','2014-02-10 12:00:00'),
	('Demo App G','Some text text','2014-02-10 12:01:00'),
	('Demo App H','Some text text text','2014-02-10 12:02:00'),
	('Demo App I','Some text text text text','2014-02-07 12:02:00');
