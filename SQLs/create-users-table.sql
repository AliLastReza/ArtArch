CREATE TABLE users (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(60) NOT NULL,
    username varchar(50) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL,
    avatar varchar(50),
    location varchar(50),
    bio text,
    createdAt timestamp DEFAULT CURRENT_TIMESTAMP,
    updatedAt timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);