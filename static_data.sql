INSERT INTO Attributes(attID, name, icon) VALUES
	('0', 'None', 'ico'),
	('1', 'Fire', 'ico'),
	('2', 'Water', 'ico'),
	('3', 'Wood', 'ico'),
	('4', 'Dark', 'ico'),
	('5', 'Light', 'ico');
	INSERT INTO Types(typeID, name, icon) VALUES
	('0', 'NULL', 'ico'),
	('1', 'Dragon', 'ico'),
	('2', 'Balance', 'ico'),
	('3', 'Physical', 'ico'),
	('4', 'Healer', 'ico'),
	('5', 'Attacker', 'ico'),
	('6', 'God', 'ico'),
	('7', 'Devil', 'ico'),
	('8', 'Machine', 'ico'),
	('9', 'Evo Material', 'ico'),
	('10', 'Enhance Material', 'ico'),
	('11', 'Awoken Material', 'ico'),
	('12', 'Vendor', 'ico');

INSERT INTO Tier(typeID, name, icon) VALUES
	('0', 'NULL', 'ico'),
	('1', 'N', 'ico'),
	('2', 'R', 'ico'),
	('3', 'SR', 'ico'),
	('4', 'UR', 'ico');

INSERT INTO Awakenings(awkID, name, icon, description, tiID) VALUES 
	-- DEFAULT BLANK
	('0', 'NULL', 'ico', 'NULL', '0'),
	-- ELEMENTAL RESISTS
	('1', 'Reduce Fire Damage', 'ico', 'Reduce Fire Damage by 5%', '0'),
	('2', 'Reduce Water Damage', 'ico', 'Reduce Water Damage by 5%', '0'),
	('3', 'Reduce Wood Damage', 'ico', 'Reduce Wood Damage by 5%', '0'),
	('4', 'Reduce Light Damage', 'ico', 'Reduce Light Damage by 5%', '0'),
	('5', 'Reduce Dark Damage', 'ico', 'Reduce Dark Damage by 5%', '0'),
	-- ROW ENHANCE
	('6', 'Enhanced Fire Attribute', 'ico', 'Matching Row of Fire will increase Fire Damage by 15%', '1'),
	('7', 'Enhanced Water Attribute', 'ico', 'Matching Row of Water will increase Water Damage by 15%', '1'),
	('8', 'Enhanced Wood Attribute', 'ico', 'Matching Row of Wood will increase Wood Damage by 15%', '1'),
	('9', 'Enhanced Light Attribute', 'ico', 'Matching Row of Light will increase Light Damage by 15%', '1'),
	('10', 'Enhanced Dark Attribute', 'ico', 'Matching Row of Dark will increase Dark Damage by 15%', '1'),
	-- ORB ENHANCE
	('11', 'Enhanced Fire Orb', 'ico', '+20% Chance of Enhanced Fire Orbs Appearing; Matching each gives +5% Damage', '1'),
	('12', 'Enhanced Water Orb', 'ico', '+20% Chance of Enhanced Water Orbs Appearing; Matching each gives +5% Damage', '1'),
	('13', 'Enhanced Wood Orb', 'ico', '+20% Chance of Enhanced Wood Orbs Appearing; Matching each gives +5% Damage', '1'),
	('14', 'Enhanced Light Orb', 'ico', '+20% Chance of Enhanced Light Orbs Appearing; Matching each gives +5% Damage', '1'),
	('15', 'Enhanced Dark Orb', 'ico', '+20% Chance of Enhanced Dark Orbs Appearing; Matching each gives +5% Damage', '1'),
	('16', 'Enhanced Heart Orb', 'ico', '+20% Chance of Enhanced Heart Orbs Appearing; Matching each gives +5% RCV', '1'),
	-- MISCELLANEOUS - RESISTS
	('17', 'Resist Poison', 'ico', '+50% Chance of Resisting Poison Orb Convert', '2'),
	('18', 'Resist Blind', 'ico', '+50% Chance of Resisting Board Blind', '2'),
	('19', 'Resist Jammer', 'ico', '+50% Chance of Resisting Jammber Orb Convert', '2'),
	('20', 'Resist Bind', 'ico', '+50% Bind Resist for Unit with Awakening', '2'),
	('21', 'Resist Lock', 'ico', '+50% Chance of Resisting Orb Lock', '2'),
	-- MISCELLANEOUS - STATS
	('22', 'Enhanced HP', 'ico', '+10% HP', '0'),
	('23', 'Enhanced ATK', 'ico', '+5% ATK', '0'),
	('24', 'Enhanced RCV', 'ico', '+10% RCV', '0'),
	-- MISCELLANEOUS - ACTUAL MISCELLANEOUS
	('25', 'Time Extend', 'ico', 'Increase Orb Movement Time by 0.5 Seconds', '2'),
	('26', 'Auto-Heal', 'ico', 'Recover 2% HP when Orbs are Matched', '0'),
	('27', 'Skill Boost', 'ico', 'Start Dungeon with Team''s Skill Cooldown reduced by 1 Turn', '3'),
	('28', 'Bind Recovery', 'ico', 'Reduce Bind by 3 turns per row of Hearts Matched', '1'),
	('29', 'Two-Pronged Attack', 'ico', 'ATK x1.5 when matching 4 Connected Orbs for Unit with Awakening', '3'),
	('30', '4-Attribute ATK Enhance', 'ico', 'ATK x1.5 when Attacking with 4+ Attributes', '3'),
	('31', 'Bonus Attack', 'ico', 'Deal 1% of opponent HP as a bonus attack when matching a column of hearts', '0'),
	-- KILLERS
	('32', 'God Killer', 'ico', 'ATK x2.5 for Unit with Awakening when Opponent''s Soul Armor is God Type', '3'),
	('33', 'Devil Killer', 'ico', 'ATK x2.5 for Unit with Awakening when Opponent''s Soul Armor is Devil Type', '3'),
	('34', 'Dragon Killer', 'ico', 'ATK x2.5 for Unit with Awakening when Opponent''s Soul Armor is Dragon Type', '3'),
	('35', 'Physical Killer', 'ico', 'ATK x2.5 for Unit with Awakening when Opponent''s Soul Armor is Physical Type', '3'),
	('36', 'Balanced Killer', 'ico', 'ATK x2.5 for Unit with Awakening when Opponent''s Soul Armor is Balanced Type', '3'),
	('37', 'Attacker Killer', 'ico', 'ATK x2.5 for Unit with Awakening when Opponent''s Soul Armor is Attacker Type', '3'),
	('38', 'Healer Killer', 'ico', 'ATK x2.5 for Unit with Awakening when Opponent''s Soul Armor is Healer Type', '3');

INSERT INTO Rarity(star, radarPoints) VALUES
	('0', '0'),
	('1', '10'),
	('2', '20'),
	('3', '30'),
	('4', '40'),
	('5', '50'),
	('6', '100'),
	('7', '200'),
	('8', '400'),
	('9', '700'),
	('10', '1000');

