CREATE TABLE video_store (
id int(11) NOT NULL AUTO_INCREMENT,
name varchar(255) NOT NULL,
category varchar(255),
length int(11),
rented BOOLEAN DEFAULT FALSE,
PRIMARY KEY (id),
UNIQUE KEY (name)
) ENGINE=InnoDB;