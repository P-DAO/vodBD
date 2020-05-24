drop database if exists vod;
create database vod;
use vod;

create table Film(
					numFilm INT NOT NULL AUTO_INCREMENT,
					titre VARCHAR (50),
					annee INT,
					realisateur VARCHAR (50),
					CONSTRAINT PK_film PRIMARY KEY (numFilm)
				);
