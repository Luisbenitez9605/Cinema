-- Database: cine

-- DROP DATABASE cine;

CREATE DATABASE cine
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'Spanish_Spain.1252'
       LC_CTYPE = 'Spanish_Spain.1252'
       CONNECTION LIMIT = -1;

       CREATE SCHEMA pelicula;

CREATE TABLE pelicula.tbl_ubicacion(
	id int NOT NULL,
	ciudad varchar(20) not null,
	barrio varchar(40) not null,
	primary key (id)	
);

CREATE TABLE pelicula.tbl_teatro(
	fk_id int not null,
	id_teatro int NOT NULL,
	descripcion varchar (20) not null,
	nombre varchar(40) not null,
	primary key (id_teatro),
	CONSTRAINT fk_EQ1 FOREIGN KEY(fk_id) REFERENCES pelicula.tbl_ubicacion(id)
);

