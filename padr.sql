-- DROP SCHEMA IF EXISTS padr CASCADE;
-- CREATE SCHEMA padr;
-- SET search_path TO padr;

CREATE TABLE Attributes (
	attID nvarchar(10) PRIMARY KEY,
	name nvarchar(10) NOT NULL, -- RGBLD
	icon nvarchar(50) NOT NULL -- Orb icons
);

CREATE TABLE Types (
	typeID nvarchar(10) PRIMARY KEY,
	name nvarchar(50) NOT NULL, -- 8 types
	icon nvarchar(50) NOT NULL -- type icons
);

CREATE TABLE Tier(
	tiID int PRIMARY KEY,
	name nvarchar(10) NOT NULL,
	icon nvarchar(50) NOT NULL
);

CREATE TABLE Awakenings (
	wID nvarchar(10) PRIMARY KEY,
	name nvarchar(10) NOT NULL,
	icon nvarchar(50) NOT NULL,
	description nvarchar(100) NOT NULL,
	tiID int NOT NULL REFERENCES Tier ON DELETE CASCADE
);

CREATE TABLE Rarity (
	star int PRIMARY KEY,
	radarPoints int NOT NULL
);

CREATE TABLE Effects (
	effID nvarchar(10) PRIMARY KEY,
	name nvarchar(10) NOT NULL
);

CREATE TABLE Actives (
	actID nvarchar(10) PRIMARY KEY,
	name nvarchar(10) NOT NULL,
	description nvarchar(100) NOT NULL,
	cooldown int NOT NULL,
	effect1 nvarchar(10) NOT NULL REFERENCES Effects,
	effect2 nvarchar(10) REFERENCES Effects,
	effect3 nvarchar(10) REFERENCES Effects
);

CREATE TABLE LeadSkills (
	leadID nvarchar(10) PRIMARY KEY,
	name nvarchar(10) NOT NULL,
	description nvarchar(100) NOT NULL
);

CREATE TABLE Leaders (
	aID nvarchar(10) PRIMARY KEY,
	nameEN nvarchar(10) NOT NULL,
	nameJP nvarchar(10) NOT NULL,
	icon nvarchar(50) NOT NULL,
	atk int NOT NULL,
	star int NOT NULL,
	att1 nvarchar(10) NOT NULL REFERENCES Attributes ON DELETE CASCADE,
	att2 nvarchar(10) REFERENCES Attributes ON DELETE CASCADE,
	type1 nvarchar(10) NOT NULL REFERENCES Types ON DELETE CASCADE,
	type2 nvarchar(10) REFERENCES Types ON DELETE CASCADE,
	type3 nvarchar(10) REFERENCES Types ON DELETE CASCADE,
	obtain nvarchar(20) NOT NULL
);

CREATE TABLE LeaderActives (
	aID nvarchar(10) FOREIGN KEY REFERENCES Armors ON DELETE CASCADE,
	a1 nvarchar(10) NOT NULL REFERENCES Actives ON DELETE CASCADE,
	a2 nvarchar(10) REFERENCES Actives ON DELETE CASCADE,
	a3 nvarchar(10) REFERENCES Actives ON DELETE CASCADE,
	a4 nvarchar(10) REFERENCES Actives ON DELETE CASCADE,
	a5 nvarchar(10) REFERENCES Actives ON DELETE CASCADE
);


CREATE TABLE LeaderAwakes (
	aID nvarchar(10) FOREIGN KEY REFERENCES Armors ON DELETE CASCADE,
	a1 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a2 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a3 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a4 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a5 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a6 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a7 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	a8 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE
);

CREATE TABLE Monsters (
	mID nvarchar(10) PRIMARY KEY,
	nameEN nvarchar(50) NOT NULL,
	nameJP nvarchar(50) NOT NULL,
	icon nvarchar(100) NOT NULL,
	star int NOT NULL REFERENCES Rarity,
	hp int NOT NULL,
	atk int NOT NULL,
	rcv int NOT NULL,
	att1 nvarchar(10) NOT NULL REFERENCES Attributes ON DELETE CASCADE,
	att2 nvarchar(10) REFERENCES Attributes ON DELETE CASCADE,
	type1 nvarchar(10) NOT NULL REFERENCES Types ON DELETE CASCADE,
	type2 nvarchar(10) REFERENCES Types ON DELETE CASCADE,
	type3 nvarchar(10) REFERENCES Types ON DELETE CASCADE,
	active nvarchar(10) NOT NULL REFERENCES Actives ON DELETE CASCADE,
	obtain nvarchar(50) NOT NULL
);

CREATE TABLE MonsterAwakes (
	mID nvarchar(10) FOREIGN KEY REFERENCES Monsters ON DELETE CASCADE,
	-- m1 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	m2 nvarchar(10) REFERENCES Tier ON DELETE CASCADE,
	m3 nvarchar(10) REFERENCES Tier ON DELETE CASCADE,
	m4 nvarchar(10) REFERENCES Tier ON DELETE CASCADE,
	m5 nvarchar(10) REFERENCES Tier ON DELETE CASCADE,
	m6 nvarchar(10) REFERENCES Tier ON DELETE CASCADE,
	m7 nvarchar(10) REFERENCES Tier ON DELETE CASCADE,
	m8 nvarchar(10) REFERENCES Tier ON DELETE CASCADE
);

