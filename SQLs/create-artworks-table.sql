CREATE TABLE artworks (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title varchar(50) NOT NULL,
    description text,
    userId int(11) NOT NULL,
    filename varchar(60) NOT NULL,
    width int(6) NOT NULL,
    height int(6) NOT NULL,
    createdAt date NOT NULL,
    updatedAt date NOT NULL
);