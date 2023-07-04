CREATE TABLE users (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL,
    avatar varchar(50) NOT NULL,
    location varchar(50) NOT NULL,
    bio text,
    createdAt date NOT NULL,
    updatedAt date NOT NULL
);