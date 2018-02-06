/*CREATE TABLE Attributes (
	attID nvarchar(10) PRIMARY KEY,
	name nvarchar(10) NOT NULL, -- RGBLD
	icon nvarchar(50) NOT NULL -- Orb icons
);*/

INSERT INTO Attributes(attID, name, icon) VALUES
	('0', 'None', 'ico'),
	('1', 'Fire', 'ico'),
	('2', 'Water', 'ico'),
	('3', 'Wood', 'ico'),
	('4', 'Dark', 'ico'),
	('5', 'Light', 'ico');

	
/*CREATE TABLE Types (
	typeID nvarchar(10) PRIMARY KEY,
	name nvarchar(10) NOT NULL, -- 8 types
	icon nvarchar(50) NOT NULL -- type icons
);*/


/*CREATE TABLE Tier(
	tiID int PRIMARY KEY,
	name nvarchar(10) NOT NULL,
	icon nvarchar(50) NOT NULL
);*/

/*CREATE TABLE Awakenings (
	wID nvarchar(10) PRIMARY KEY,
	name nvarchar(10) NOT NULL,
	icon nvarchar(50) NOT NULL,
	description nvarchar(100) NOT NULL,
	rID int NOT NULL REFERENCES Tier ON DELETE CASCADE
);*/

/*CREATE TABLE Rarity (
	star int PRIMARY KEY,
	radarPoints int NOT NULL
);*/
