CREATE DATABASE Oprema;

USE Oprema;

CREATE TABLE Vrsta_robe(
id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
vrsta_robe VARCHAR(20) NOT NULL
)Engine=InnoDB;

CREATE TABLE Namena(
id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
namena VARCHAR(20) NOT NULL
)Engine=InnoDB;

CREATE TABLE Marka(
id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
marka VARCHAR(25) NOT NULL
)Engine=InnoDB;

CREATE TABLE Boja(
id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
boja VARCHAR(25) NOT NULL
)Engine=InnoDB;

CREATE TABLE Roba(
id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_vrsta_robe INT(5) NOT NULL,
id_marka INT(5) NOT NULL,
naziv_robe VARCHAR(30) NULL,
id_namena INT(5) NULL,
velicina VARCHAR(6) NOT NULL,
cena INT(10) NOT NULL,
pol VARCHAR(6) NOT NULL,
id_boja INT(5) NOT NULL,
FOREIGN KEY(id_vrsta_robe) REFERENCES Vrsta_robe(id)
ON UPDATE CASCADE
ON DELETE CASCADE,

FOREIGN KEY(id_namena) REFERENCES Namena(id)
ON UPDATE CASCADE
ON DELETE CASCADE,

FOREIGN KEY(id_marka) REFERENCES Marka(id)
ON UPDATE CASCADE
ON DELETE CASCADE,

FOREIGN KEY(id_boja) REFERENCES Boja(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)Engine=InnoDB;

CREATE TABLE Grad(
id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
grad VARCHAR(30) NOT NULL
)Engine=InnoDB;

CREATE TABLE Kupci(
id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
ime VARCHAR(20) NOT NULL,
prezime VARCHAR(30) NOT NULL,
adresa VARCHAR(150) NOT NULL,
telefon VARCHAR(10) NOT NULL UNIQUE,
id_grad INT(5) NOT NULL,
email VARCHAR(100) NOT NULL UNIQUE,
FOREIGN KEY(id_grad) REFERENCES Grad(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)Engine=InnoDB;

CREATE TABLE Narudzbine(
id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_robe INT(5) NOT NULL,
id_kupca INT(5) NOT NULL,
datum_narucivanja DATE,
FOREIGN KEY(id_robe) REFERENCES Roba(id)
ON UPDATE CASCADE
ON DELETE CASCADE,

FOREIGN KEY(id_kupca) REFERENCES Kupci(id)
ON UPDATE CASCADE
ON DELETE CASCADE
)Engine=InnoDB;

CREATE TABLE prijava(
id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
korisnicko_ime INT(30) NOT NULL,
lozinka INT(30) NOT NULL
)Engine=InnoDB;

INSERT INTO Vrsta_robe VALUES
(1,'patike'),
(2,'kopacke'),
(3,'cipele'),
(4,'papuce'),
(5,'trenerke'),
(6,'majice'),
(7,'sorcevi'),
(8,'kupaci');

INSERT INTO Namena VALUES
(1,'fudbal'),
(2,'kosarka'),
(3,'odbojka'),
(4,'rukomet'),
(5,'tenis'),
(6,'trcanje'),
(7,'lifestyle'),
(8,'plivanje'),
(9,'fitnes');

INSERT INTO Marka VALUES
(1,'Adidas'),
(2,'Nike'),
(3,'Puma'),
(4,'Reebok'),
(5,'New Balance'),
(6,'Umbro'),
(7,'Converse'),
(8,'Diadora'),
(9,'Arena'),
(10,'Rider');

INSERT INTO Boja VALUES
(1,'Crvena'),
(2,'Plava'),
(3,'Zelena'),
(4,'Narandzasta'),
(5,'Ljubicasta'),
(6,'Roze'),
(7,'Zuta'),
(8,'Braon'),
(9,'Crna'),
(10,'Bela');

INSERT INTO Grad VALUES
(1,'Beograd'),
(2,'Novi Sad'),
(3,'Nis'),
(4,'Leskovac'),
(5,'Pirot'),
(6,'Vranje'),
(7,'Uzice'),
(8,'Kragujevac'),
(9,'Subotica'),
(10,'Paracin'),
(11,'Jagodina'),
(12,'Pancevo'),
(13,'Smederevo'),
(14,'Krusevac'),
(15,'Bor'),
(16,'Zajecar'),
(17,'Negotin');

INSERT INTO Kupci(id,ime,prezime,adresa,telefon,id_grad,email) VALUES
(1,'Pera','Peric','Visegradska 155','0641234321',3,'pera@hotmail.com'),
(2,'Mika','Mikic','Kosmajska 3','063726910',1,'mika@hotmail.com'),
(3,'Laza','Lazic','Ilije Garasanina 18','0616720132',6,'laza@hotmail.com'),
(4,'Sima','Simic','Podunavska bb','0639301342',10,'sima@hotmail.com'),
(5,'Petar','Petrovic','Obilicev Venac 29','0651267834',3,'petar@hotmail.com');

INSERT INTO Roba(id_vrsta_robe,id_marka,naziv_robe,id_namena,velicina,cena,pol,id_boja)VALUES
(1,1,'Predator',1,'43',4000,'muski',1),
(1,2,'Michael Jordan',2,'42',6000,'muski',9),
(3,3,NULL,7,41,5500,'muski',10),
(2,2,'Mercurial',1,'44',5700,'muski',2),
(4,2,NULL,7,'41',1500,'zenski',7),
(1,2,'Michael Jordan',2,'42',6000,'muski',9),
(4,10,NULL,7,'43',1500,'zenski',6),
(5,1,NULL,1,'S',4500,'muski',7),
(5,2,NULL,9,'XL',6000,'muski',1),
(8,9,NULL,8,'M',5500,'muski',10),
(7,8,NULL,6,'L',5700,'muski',2),
(6,3,NULL,9,'M',1500,'zenski',7),
(7,2,'Mercurial',1,'XS',1500,'zenski',1),
(8,2,NULL,8,'XXL',1500,'zenski',6);

INSERT INTO Narudzbine(id_robe,id_kupca,datum_narucivanja) VALUES
(1,1,'2017-03-10'),
(2,4,'2017-04-13'),
(5,3,'2017-05-15');

