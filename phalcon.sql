PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "factory" (
	`id` INTEGER NOT NULL,
	`name` VARCHAR(64) NOT NULL,
	PRIMARY KEY ("id")
);
INSERT INTO factory VALUES(146,'Kennaway');
INSERT INTO factory VALUES(147,'Kerberos');
INSERT INTO factory VALUES(148,'Kerneltrap');
INSERT INTO factory VALUES(149,'Kuriyama');
INSERT INTO factory VALUES(150,'LAN');
INSERT INTO factory VALUES(151,'LDAP');
INSERT INTO factory VALUES(152,'LGPL');
INSERT INTO factory VALUES(153,'LLC');
INSERT INTO factory VALUES(154,'LOMAC');
INSERT INTO factory VALUES(155,'LPD');
INSERT INTO factory VALUES(156,'AB');
INSERT INTO factory VALUES(157,'AB');
INSERT INTO factory VALUES(158,'AB');
CREATE TABLE IF NOT EXISTS "products" (
	`id` INTEGER NOT NULL,
	`name` VARCHAR(64) NOT NULL,
	`factory_id` INTEGER NOT NULL,
	PRIMARY KEY ("id")
);
INSERT INTO products VALUES(1,'123',0);
INSERT INTO products VALUES(2,'123',0);
INSERT INTO products VALUES(3,'123',2);
INSERT INTO products VALUES(4,'123',2);
INSERT INTO products VALUES(5,'123',2);
INSERT INTO products VALUES(6,'123',2);
INSERT INTO products VALUES(7,'123',2);
INSERT INTO products VALUES(8,'123',6);
INSERT INTO products VALUES(9,'123',6);
INSERT INTO products VALUES(10,'123',6);
INSERT INTO products VALUES(11,'123',6);

CREATE TABLE IF NOT EXISTS "user" (
        id INTEGER NOT NULL,
        login VARCHAR(64) NOT NULL,
        name VARCHAR(64) NOT NULL,
        password VARCHAR(64) NOT NULL,
        PRIMARY KEY ("id")
);
INSERT INTO user VALUES(146,'Kennaway','Kennaway','password');
INSERT INTO user VALUES(147,'Kerberos','Kerberos','password');
INSERT INTO user VALUES(149,'Kerneltrap','Kuriyama','password');
INSERT INTO user VALUES(150,'LAN','LAN','password');
INSERT INTO user VALUES(151,'LDAP','LDAP','password');
INSERT INTO user VALUES(152,'LGPL','LGPL','password');
INSERT INTO user VALUES(153,'LLC','LLC','password');
INSERT INTO user VALUES(154,'LOMAC','LOMAC','password');
COMMIT;
