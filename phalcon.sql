PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE domain (
    id INTEGER NOT NULL,
    name text,
    PRIMARY KEY ("id")

);
INSERT INTO domain VALUES(2,'sample.org');
CREATE TABLE user (
    id INTEGER NOT NULL,
    domain_id INTEGER,
    name text,
    gecos text,
    password text,
    PRIMARY KEY ("id")
);
INSERT INTO user VALUES(1,2,'user.a','User','1234567');
CREATE TABLE alias (
    id INTEGER NOT NULL,
    domain_id INTEGER,
    name text,
    list text,
    PRIMARY KEY ("id")
);
INSERT INTO alias VALUES(1,2,'user','shadow@sample.org');
CREATE TABLE suser (
    id INTEGER NOT NULL,
    name text,
    gecos text,
    password text,
    PRIMARY KEY ("id")
);
COMMIT;
