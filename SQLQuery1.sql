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