-- DROP SCHEMA IF EXISTS padr CASCADE;
CREATE SCHEMA padr;
SET search_path TO padr;

CREATE TABLE Attributes (
	attID varchar(10) PRIMARY KEY,
	name varchar(10) NOT NULL,
	icon varchar(50) NOT NULL
);

CREATE TABLE Types (
	typeID varchar(10) PRIMARY KEY,
	name varchar(10) NOT NULL,
	icon varchar(50) NOT NULL
);


CREATE TABLE Actives (
	actID varchar(10) PRIMARY KEY,
	name varchar(10) NOT NULL,
	description varchar(100) NOT NULL,
	cooldown int NOT NULL
);

CREATE TABLE Leaders (
	leadID varchar(10) PRIMARY KEY,
	name varchar(10) NOT NULL,
	description varchar(100) NOT NULL
);


CREATE TABLE Rarity(
	rID int PRIMARY KEY,
	name varchar(10) NOT NULL,
	icon varchar(50) NOT NULL
);

CREATE TABLE Awakenings (
	wID varchar(10) PRIMARY KEY,
	name varchar(10) NOT NULL,
	icon varchar(50) NOT NULL,
	description varchar(100) NOT NULL,
	rID int NOT NULL REFERENCES Rarity ON DELETE CASCADE
);

CREATE TABLE Armors (
	aID varchar(10) PRIMARY KEY,
	nameEN varchar(10) NOT NULL,
	nameJP varchar(10) NOT NULL,
	icon varchar(50) NOT NULL,
	atk int NOT NULL,
	rarity int NOT NULL,
	att1 varchar(10) NOT NULL REFERENCES Attributes ON DELETE CASCADE,
	att2 varchar(10) REFERENCES Attributes ON DELETE CASCADE,
	type1 varchar(10) NOT NULL REFERENCES Types ON DELETE CASCADE,
	type2 varchar(10) REFERENCES Types ON DELETE CASCADE,
	obtainable boolean NOT NULL,
	rareGatcha boolean NOT NULL
);

CREATE TABLE

CREATE TABLE ArmorActives (
	aID varchar(10) PRIMARY KEY REFERENCES Armors ON DELETE CASCADE,
	a1 varchar(10) NOT NULL REFERENCES Actives ON DELETE CASCADE,
	a2 varchar(10) REFERENCES Actives ON DELETE CASCADE,
	a3 varchar(10) REFERENCES Actives ON DELETE CASCADE,
	a4 varchar(10) REFERENCES Actives ON DELETE CASCADE,
	a5 varchar(10) REFERENCES Actives ON DELETE CASCADE,
);


CREATE TABLE ArmorAwakes (
	aID varchar(10) PRIMARY KEY REFERENCES Armors ON DELETE CASCADE,
	a1 varchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a2 varchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a3 varchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a4 varchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a5 varchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a6 varchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a7 varchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a8 varchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,	
);

CREATE TABLE Monsters (
	mID varchar(10) PRIMARY KEY,
	nameEN varchar(10) NOT NULL,
	nameJP varchar(10) NOT NULL,
	icon varchar(50) NOT NULL,
	hp int NOT NULL,
	atk int NOT NULL,
	rcv int NOT NULL,
	att1 varchar(10) NOT NULL REFERENCES Attributes ON DELETE CASCADE,
	att2 varchar(10) REFERENCES Attributes ON DELETE CASCADE,
	type1 varchar(10) NOT NULL REFERENCES Types ON DELETE CASCADE,
	type2 varchar(10) REFERENCES Types ON DELETE CASCADE,
	active varchar(10) NOT NULL REFERENCES Actives ON DELETE CASCADE,
	obtain varchar(50)
);

CREATE TABLE MonsterAwakes (
	mID varchar(10) PRIMARY KEY REFERENCES Monsters ON DELETE CASCADE,
	-- a1 varchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	m2 varchar(10) NOT NULL REFERENCES Rarity ON DELETE CASCADE,
	m3 varchar(10) NOT NULL REFERENCES Rarity ON DELETE CASCADE,
	m4 varchar(10) NOT NULL REFERENCES Rarity ON DELETE CASCADE,
	m5 varchar(10) NOT NULL REFERENCES Rarity ON DELETE CASCADE,
	m6 varchar(10) NOT NULL REFERENCES Rarity ON DELETE CASCADE,
	m7 varchar(10) NOT NULL REFERENCES Rarity ON DELETE CASCADE,
	m8 varchar(10) NOT NULL REFERENCES Rarity ON DELETE CASCADE,	
);

