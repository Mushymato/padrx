-- DROP SCHEMA IF EXISTS padr CASCADE;
-- CREATE SCHEMA padr;
-- SET search_path TO padr;

CREATE TABLE Attributes (
	attID nvarchar(10) PRIMARY KEY,
	name nvarchar(10) NOT NULL, -- RGBLD
	icon nvarchar(256) NOT NULL -- Orb icons
);

CREATE TABLE Types (
	typeID nvarchar(10) PRIMARY KEY,
	name nvarchar(256) NOT NULL, -- 8 types
	icon nvarchar(256) NOT NULL -- type icons
);

CREATE TABLE Tiers(
	tiID int PRIMARY KEY,
	name nvarchar(10) NOT NULL,
	ico nvarchar(256) NOT NULL
);

CREATE TABLE Awakenings (
	awID nvarchar(10) PRIMARY KEY,
	name nvarchar(256) NOT NULL,
	icon nvarchar(256) NOT NULL,
	description nvarchar(256) NOT NULL,
	tiID int NOT NULL REFERENCES Tier ON DELETE CASCADE
);

CREATE TABLE Rarity (
	star int PRIMARY KEY,
	radarPoints int NOT NULL
);

CREATE TABLE Actives (
	actID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (actID),
	name nvarchar(256) NOT NULL,
	description nvarchar(256) NOT NULL,
	cooldown int NOT NULL,
);

CREATE TABLE Leaders (
	lID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (lID),
	nameEN nvarchar(256) NOT NULL,
	nameJP nvarchar(256) NOT NULL,
	icon nvarchar(256) NOT NULL,
	image nvarchar(256),
	atk int NOT NULL,
	star int NOT NULL,
	leadSkill nvarchar(256) NOT NULL,
	att1 nvarchar(10) NOT NULL REFERENCES Attributes ON DELETE CASCADE,
	att2 nvarchar(10) REFERENCES Attributes ON DELETE CASCADE,
	type1 nvarchar(10) NOT NULL REFERENCES Types ON DELETE CASCADE,
	type2 nvarchar(10) REFERENCES Types ON DELETE CASCADE,
	type3 nvarchar(10) REFERENCES Types ON DELETE CASCADE,
	obtain nvarchar(256) NOT NULL
);

CREATE TABLE LeaderActives (
	lID nvarchar(10) FOREIGN KEY REFERENCES Leaders ON DELETE CASCADE,
	aw1 nvarchar(10) NOT NULL REFERENCES Actives ON DELETE CASCADE,
	aw2 nvarchar(10) REFERENCES Actives ON DELETE CASCADE,
	aw3 nvarchar(10) REFERENCES Actives ON DELETE CASCADE,
	aw4 nvarchar(10) REFERENCES Actives ON DELETE CASCADE,
	aw5 nvarchar(10) REFERENCES Actives ON DELETE CASCADE
);


CREATE TABLE LeaderAwakes (
	lID nvarchar(10) FOREIGN KEY REFERENCES Leaders ON DELETE CASCADE,
	aw1 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	aw2 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	aw3 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	aw4 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	aw5 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	aw6 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	aw7 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	aw8 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE
);

CREATE TABLE Monsters (
	mID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (mID),
	nameEN nvarchar(256) NOT NULL,
	nameJP nvarchar(256) NOT NULL,
	icon nvarchar(256) NOT NULL DEFAULT 'ico',
	star int NOT NULL REFERENCES Rarity,
	att1 nvarchar(10) NOT NULL REFERENCES Attributes ON DELETE CASCADE,
	att2 nvarchar(10) REFERENCES Attributes ON DELETE CASCADE,
	type1 nvarchar(10) NOT NULL REFERENCES Types ON DELETE CASCADE,
	type2 nvarchar(10) REFERENCES Types ON DELETE CASCADE,
	type3 nvarchar(10) REFERENCES Types ON DELETE CASCADE,
	hp int NOT NULL,
	atk int NOT NULL,
	rcv int NOT NULL,
	active nvarchar(256) NOT NULL REFERENCES Actives ON DELETE CASCADE,
	obtain nvarchar(256)
);

CREATE TABLE MonsterAwakes (
	mID int(11) PRIMARY KEY REFERENCES Monsters ON DELETE CASCADE,
	-- m1 nvarchar(10) NOT NULL REFERENCES Awakenings ON DELETE CASCADE,
	m2 int(11) REFERENCES Tier ON DELETE CASCADE,
	m3 int(11) REFERENCES Tier ON DELETE CASCADE,
	m4 int(11) REFERENCES Tier ON DELETE CASCADE,
	m5 int(11) REFERENCES Tier ON DELETE CASCADE,
	m6 int(11) REFERENCES Tier ON DELETE CASCADE,
	m7 int(11) REFERENCES Tier ON DELETE CASCADE,
	m8 int(11) REFERENCES Tier ON DELETE CASCADE
);

-- Fix monster data
SET SQL_SAFE_UPDATES = 0;
update Monsters m
set m.att2=NULL where m.att2="";
update Monsters m
set m.obtain=NULL where m.obtain="";
update Monsters m
set m.type1=(
	select a.typeID from Types a where m.type1 = a.name
);
update Monsters m
set m.type2=(
	select a.typeID from Types a where m.type2 = a.name
);
update Monsters m
set m.type3=(
	select a.typeID from Types a where m.type3 = a.name
);
SET SQL_SAFE_UPDATES = 1;

BEGIN;
SET SQL_SAFE_UPDATES = 0;
update Monsters m
set m.active=(
	select a.actID from Actives a where m.active = a.name
);
SET SQL_SAFE_UPDATES = 1;

-- Fix monster awake data
SET SQL_SAFE_UPDATES = 0;
update ma mona
set mona.mID=(
	select m.mID from Monsters m where m.nameEN = mona.mID and m.star = mona.star
);
update ma mona
set mona.m2=(
	select t.tiID from Tiers t where t.name = mona.m2
);
update ma mona
set mona.m3=(
	select t.tiID from Tiers t where t.name = mona.m3
);
update ma mona
set mona.m4=(
	select t.tiID from Tiers t where t.name = mona.m4
);
update ma mona
set mona.m5=(
	select t.tiID from Tiers t where t.name = mona.m5
);
update ma mona
set mona.m6=(
	select t.tiID from Tiers t where t.name = mona.m6
);
update ma mona
set mona.m7=(
	select t.tiID from Tiers t where t.name = mona.m7
);
update ma mona
set mona.m8=(
	select t.tiID from Tiers t where t.name = mona.m8
);
SET SQL_SAFE_UPDATES = 1;

INSERT INTO `proticsi_PADR`.`Monsters`
(`mID`,`nameEN`,`nameJP`,`ico`,`rarity`,`att1`,`att2`,`type1`,`type2`,`type3`,`hp`,`atk`,`rcv`,`active`,`obtain`)
VALUES(default,?,?,?,?,?,?,?,?,NULL,?,?,?,?,?);
sssisssssiiiis

INSERT INTO `proticsi_PADR`.`Actives`
(`actID`,`name`,`description`,`cooldown`)
VALUES(default,?,?,?);

UPDATE `proticsi_PADR`.`Monsters`
SET
`nameEN` = ?,
`nameJP` = ?,
`icon` = ?,
`rarity` = ?,
`att1` = ?,
`att2` = ?,
`type1` = ?,
`type2` = ?,
`type3` = ?,
`hp` = ?,
`atk` = ?,
`rcv` = ?,
`active` = ?,
`obtain` = ?
WHERE `mID` = ?;

