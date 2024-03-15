Create database Ads

Use Ads

CREATE TABLE tbGender(  
IdGen int PRIMARY KEY,  
Gender varchar (10) NOT NULL 
);

CREATE TABLE tbPosition(  
IdPos int PRIMARY KEY,  
Position char (5) NOT NULL 
);

CREATE TABLE tbTeams(  
IdTeam int PRIMARY KEY,  
TeamName varchar (80) NOT NULL 
);
insert into tbUser 
values(1,'user',(select fun_encriptar('miclave'))
CREATE TABLE tbUser(  
IdUser int PRIMARY KEY,  
UserC varchar (100) NOT NULL,
Password binary(100) NOT NULL 
);

CREATE TABLE tbCountry(  
IdCtry int PRIMARY KEY,  
CtryName varchar (100) NOT NULL,
);


CREATE TABLE tbVoters(  
IdVot int PRIMARY KEY,  
NameV varchar (100) NOT NULL,
LastV varchar (100) NOT NULL,
DuiV varchar (10) unique NOT NULL,
IdGen int not null,
CONSTRAINT FK_IdGender FOREIGN KEY (IdGen)
      REFERENCES tbGender (IdGen)
);

CREATE TABLE tbPlayer(  
IdPla int PRIMARY KEY,  
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
CONSTRAINT FK_IdUser FOREIGN KEY (IdUser)
      REFERENCES tbUser (IdUser),
CONSTRAINT FK_IdPos FOREIGN KEY (IdPos)
      REFERENCES tbPosition (IdPos)
);


CREATE TABLE tbVotes (
IdVote Int Primary Key,
IdPla int not null,
IdVot int unique not null,
DateVot date not null,
CONSTRAINT FK_IdPla FOREIGN KEY (IdPla)
      REFERENCES tbPlayer (IdPla),
CONSTRAINT FK_IdVot FOREIGN KEY (IdVot)
      REFERENCES tbvoters (IdVot),
);

go
create function fun_encriptar(@valor varchar(255))
returns binary(100)
as
begin 
declare @encriptado binary(100);
set @encriptado=HASHBYTES('SHA1', @valor);
return @encriptado ;
end

