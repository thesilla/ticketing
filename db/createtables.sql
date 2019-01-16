create table users (
userID varchar(255) NOT NULL,
firstname varchar(255) NOT NULL,
lastname varchar(255) NOT NULL,
email varchar(255) NOT NULL,
title varchar(255) NOT NULL,
password varchar(255) NOT NULL,
PRIMARY KEY (userID)
);


create table tickets (
ticketID int(800) AUTO_INCREMENT NOT NULL,
subject varchar(255) NOT NULL, 
body varchar(8000), 
userID varchar(255) NOT NULL,
requestedby varchar(255) NOT NULL,
datesubmitted DATETIME NOT NULL,
orderID varchar(255),
priority int(4) NOT NULL,
category varchar(255) NOT NULL,
status varchar(255) NOT NULL,
assignedto varchar(255),
completed varchar(255) NOT NULL,
dateresolved DATETIME,
vendor varchar(255),
reason varchar(255),
PRIMARY KEY (ticketID),
FOREIGN KEY (userID) REFERENCES users (userID)
    );




create table dispositions (
dispoID int(255) AUTO_INCREMENT NOT NULL,
userID varchar(255) NOT NULL,
body varchar(8000), 
datesubmitted DATETIME NOT NULL,
ticketID int(255) NOT NULL,
PRIMARY KEY (dispoID),
FOREIGN KEY (userID) REFERENCES users (userID),
FOREIGN KEY (ticketID) REFERENCES tickets (ticketID)
    );

CREATE TABLE `employees` ( 
`id` INT(255) NOT NULL AUTO_INCREMENT , 
`fname` VARCHAR(255) NOT NULL , 
`lname` VARCHAR(255) NOT NULL , 
`email` VARCHAR(255) NOT NULL , 
PRIMARY KEY (`id`));









INSERT INTO `users`(
`userID`,
`firstname`,
`lastname`,
`email`,
`title`,
`password`
)
VALUES (
'admin',
'Admin',
'Admin',
'admin@admin.com',
'admin',
'admin'
);