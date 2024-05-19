Create database Ads

Use Ads

CREATE TABLE tbGender(  
IdGen int PRIMARY KEY identity,  
Gender varchar (10) NOT NULL 
);

CREATE TABLE tbPosition(  
IdPos int PRIMARY KEY identity,  
Position char (5) NOT NULL 
);

CREATE TABLE tbTeams(  
IdTeam int PRIMARY KEY identity,  
TeamName varchar (80) NOT NULL 
);


CREATE TABLE tbCountry(  
IdCtry int PRIMARY KEY identity,  
CtryName varchar (100) NOT NULL,
);
CREATE TABLE tbUser(  
IdUser int PRIMARY KEY identity,  
UserC varchar (100) NOT NULL,
Passwordc varchar(100) NOT NULL 
);

CREATE TABLE tbVoters(  
IdVot int PRIMARY KEY identity,  
NameV varchar (100) NOT NULL,
LastV varchar (100) NOT NULL,
DuiV varchar (10) unique NOT NULL,
IdGen int not null,
IdUser int not null,
CONSTRAINT FK_IdGender FOREIGN KEY (IdGen)
      REFERENCES tbGender (IdGen),
CONSTRAINT FK_IdUser FOREIGN KEY (IdUser)
      REFERENCES tbUser (IdUser)
);

CREATE TABLE tbPlayer(  
IdPla int PRIMARY KEY identity ,  
NameP varchar (100) NOT NULL,
LastP varchar (100) NOT NULL,
AgeP varchar (10) unique NOT NULL,
AsistP smallint Not Null,
GoalsP smallint Not Null,
MinsPlayed Smallint Not Null,
ImgP varchar (300) Not Null,
StatusP bit Not Null,
IdTeam int not null,
IdCtry int not null,
IdUser int not null,
IdPos int  not null,
CONSTRAINT FK_IdTeam FOREIGN KEY (IdTeam)
      REFERENCES tbTeams (IdTeam),
CONSTRAINT FK_IdCtry FOREIGN KEY (IdCtry)
      REFERENCES tbCountry (IdCtry),
CONSTRAINT FK_IdPos FOREIGN KEY (IdPos)
      REFERENCES tbPosition (IdPos)
);

SELECT 
    tbVoters.IdVot, tbVoters.NameV, tbVoters.LastV, tbVoters.DuiV, 
    tbGender.Gender,tbUser.UserC, tbUser.Passwordc
FROM 
    tbVoters
INNER JOIN 
    tbUser ON tbVoters.IdUser = tbUser.IdUser
INNER JOIN 
    tbGender ON tbVoters.IdGen = tbGender.IdGen;

select IdPla, NAmeP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, tbTeams.TeamName, tbCountry.CtryName, tbPosition.Position
from tbPlayer inner join tbTeams  on tbPlayer.IdTeam = tbTeams.IdTeam
inner join tbPosition on tbPlayer.IdPos = tbPosition.IdPos
inner join tbCountry on tbPlayer.IdCtry = tbCountry.IdCtry

select IdPos, Position from tbPosition

select IdCtry, CtryName from tbCountry

select IdTeam, TeamName from tbTeams

CREATE TABLE tbVotos (
IdVote Int Primary Key identity,
IdPla int not null,
IdVot int unique not null,
DateVot date not null,
CONSTRAINT FK_IdPla FOREIGN KEY (IdPla)
      REFERENCES tbPlayer (IdPla),
CONSTRAINT FK_IdVot FOREIGN KEY (IdVot)
      REFERENCES tbvoters (IdVot)
);

select * from tbUser
insert into tbUser 
values('user','123456a')
insert into tbGender
values('Hombre'),('Mujer'),('Otro')
insert into tbVoters 
values('jorge','polanco','009988-8',1,1)
SELECT tbVoters.DuiV, tbVoters.IdVot, tbUser.Passwordc
FROM tbVoters
INNER JOIN tbUser ON tbVoters.IdUser = tbUser.IdUser
WHERE tbVoters.DuiV = ;
SELECT 
    tbVoters.IdVot, tbVoters.NameV, tbVoters.LastV, tbVoters.DuiV, 
    tbGender.Gender,tbUser.UserC, tbUser.Passwordc
FROM 
    tbVoters
INNER JOIN 
    tbUser ON tbVoters.IdUser = tbUser.IdUser
INNER JOIN 
    tbGender ON tbVoters.IdGen = tbGender.IdGen;



    -- Inserts for tbGender
INSERT INTO tbGender (Gender) VALUES ('Male');
INSERT INTO tbGender (Gender) VALUES ('Female');

-- Inserts for tbPosition
INSERT INTO tbPosition (Position) VALUES ('GK'); -- Goalkeeper
INSERT INTO tbPosition (Position) VALUES ('DEF'); -- Defender
INSERT INTO tbPosition (Position) VALUES ('MID'); -- Midfielder
INSERT INTO tbPosition (Position) VALUES ('FWD'); -- Forward
INSERT INTO tbPosition (Position) VALUES ('SUB'); -- Substitute

-- Inserts for tbTeams
INSERT INTO tbTeams (TeamName) VALUES ('FC Barcelona');
INSERT INTO tbTeams (TeamName) VALUES ('Real Madrid');
INSERT INTO tbTeams (TeamName) VALUES ('Manchester United');
INSERT INTO tbTeams (TeamName) VALUES ('Liverpool FC');
INSERT INTO tbTeams (TeamName) VALUES ('Juventus');

-- Inserts for tbCountry
INSERT INTO tbCountry (CtryName) VALUES ('United States');
INSERT INTO tbCountry (CtryName) VALUES ('Spain');
INSERT INTO tbCountry (CtryName) VALUES ('United Kingdom');
INSERT INTO tbCountry (CtryName) VALUES ('Italy');
INSERT INTO tbCountry (CtryName) VALUES ('Germany');

-- Inserts for tbUser
INSERT INTO tbUser (UserC, Passwordc) VALUES ('user1', 'password1');
INSERT INTO tbUser (UserC, Passwordc) VALUES ('user2', 'password2');
INSERT INTO tbUser (UserC, Passwordc) VALUES ('user3', 'password3');
INSERT INTO tbUser (UserC, Passwordc) VALUES ('user4', 'password4');
INSERT INTO tbUser (UserC, Passwordc) VALUES ('user5', 'password5');

-- Inserts for tbVoters
INSERT INTO tbVoters (NameV, LastV, DuiV, IdGen, IdUser) VALUES ('John', 'Doe', '1234567890', 1, 1);
INSERT INTO tbVoters (NameV, LastV, DuiV, IdGen, IdUser) VALUES ('Jane', 'Smith', '0987654321', 2, 2);
INSERT INTO tbVoters (NameV, LastV, DuiV, IdGen, IdUser) VALUES ('Alex', 'Johnson', '1122334455', 3, 3);
INSERT INTO tbVoters (NameV, LastV, DuiV, IdGen, IdUser) VALUES ('Chris', 'Lee', '2233445566', 4, 4);
INSERT INTO tbVoters (NameV, LastV, DuiV, IdGen, IdUser) VALUES ('Pat', 'Taylor', '3344556677', 5, 5);

-- Inserts for tbPlayer
INSERT INTO tbPlayer (NameP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, IdTeam, IdCtry, IdUser, IdPos) 
VALUES ('Lionel', 'Messi', '36', 15, 25, 2700, 'messi.jpg', 1, 1, 2, 1, 4);
INSERT INTO tbPlayer (NameP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, IdTeam, IdCtry, IdUser, IdPos) 
VALUES ('Cristiano', 'Ronaldo', '38', 12, 20, 2500, 'ronaldo.jpg', 1, 2, 3, 2, 4);
INSERT INTO tbPlayer (NameP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, IdTeam, IdCtry, IdUser, IdPos) 
VALUES ('Neymar', 'Jr', '32', 10, 18, 2400, 'neymar.jpg', 1, 1, 4, 3, 4);
INSERT INTO tbPlayer (NameP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, IdTeam, IdCtry, IdUser, IdPos) 
VALUES ('Kylian', 'Mbappe', '25', 8, 22, 2600, 'mbappe.jpg', 1, 1, 5, 1, 4);
INSERT INTO tbPlayer (NameP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, IdTeam, IdCtry, IdUser, IdPos) 
VALUES ('Kevin', 'De Bruyne', '32', 18, 15, 2800, 'debruyne.jpg', 1, 3, 2, 4, 3);

-- Inserts for tbVotos
INSERT INTO tbVotos (IdPla, IdVot, DateVot) VALUES (1, 1, '2023-05-01');
INSERT INTO tbVotos (IdPla, IdVot, DateVot) VALUES (2, 2, '2023-05-02');
INSERT INTO tbVotos (IdPla, IdVot, DateVot) VALUES (3, 3, '2023-05-03');
INSERT INTO tbVotos (IdPla, IdVot, DateVot) VALUES (4, 4, '2023-05-04');
INSERT INTO tbVotos (IdPla, IdVot, DateVot) VALUES (5, 5, '2023-05-05');
