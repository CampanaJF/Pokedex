drop database if exists pokedex;
create database pokedex;
use pokedex;

drop table if exists tipo;
CREATE TABLE tipo(
    id int auto_increment primary key,
    tipo varchar(20),
    imagen varchar(100)
);

drop table if exists pokemon;
create table pokemon(
    id int auto_increment primary key,
    numero int unique,
    nombre varchar(20),
    tipo1 int NOT NULL ,
    tipo2 int,
    descripcion text,
    imagen varchar(20),
    FOREIGN KEY (tipo1) REFERENCES tipo(id),
    FOREIGN KEY (tipo2) REFERENCES tipo(id)
);

create table usuario(
    id int auto_increment primary key,
    nombre varchar (20),
    contraseña varchar (40),
    esAdmin int
);

INSERT INTO tipo (tipo, imagen)
    VALUES ('acero', 'acero.jpeg'), -- 1
           ('agua', 'agua.jpeg'), -- 2
           ('bicho', 'bicho.jpeg'), -- 3
           ('dragon', 'dragon.jpeg'), -- 4
           ('electrico', 'electrico.jpeg'), -- 5
           ('fantasma', 'fantasma.jpeg'), -- 6
           ('fuego', 'fuego.jpeg'), -- 7
           ('hada', 'hada.jpeg'), -- 8
           ('hielo', 'hielo.jpeg'), -- 9
           ('lucha', 'lucha.jpeg'), -- 10
           ('normal', 'normal.jpeg'), -- 11
           ('planta', 'planta.jpeg'), -- 12
           ('psiquico', 'psiquico.jpeg'), -- 13
           ('roca', 'roca.jpeg'), -- 14
           ('tierra', 'tierra.jpeg'), -- 15
           ('veneno', 'veneno.jpeg'), -- 16
           ('volador', 'volador.jpeg'); -- 17

insert into usuario (nombre, contraseña, esAdmin)
			 values('admin', md5('admin'), 1);
             
insert into pokemon (numero,nombre,tipo1,tipo2,descripcion,imagen)
              values(094,'Gengar', 6, 16,
              'Gengar es un Pokémon de tipo fantasma/veneno introducido en la primera generación. Es la evolución de Haunter y,
              a partir de la sexta generación, puede megaevolucionar en Mega-Gengar. ','Gengar.jpeg');

insert into pokemon (numero,nombre,tipo1,descripcion,imagen)
              values(143,'Snorlax', 11,
              'Snorlax es un Pokémon de tipo normal introducido en la primera generación.
              A partir de la cuarta generación tiene una preevolución llamada Munchlax. ','Snorlax.jpeg');
              
insert into pokemon (numero,nombre,tipo1,tipo2,descripcion,imagen)
              values(093,'Haunter', 6, 16,
              'Haunter es un Pokémon de tipo fantasma/veneno introducido en la primera generación. Es la evolución de Gastly. ','Haunter.jpeg');

insert into pokemon (numero,nombre,tipo1,tipo2,descripcion)
values(006,'Charizard', 7, 17,
       'Charizard es un Pokémon de tipo fuego/volador, introducido en la primera generación. Es la evolución de Charmeleon y, a partir de la sexta generación, puede megaevolucionar en Mega-Charizard X o en Mega-Charizard Y. En la Octava generación puede realizar Gigamax y transformarse en Charizard Gigamax.');

insert into pokemon (numero,nombre,tipo1,tipo2,descripcion)
values(018,'pidgeot', 11, 17,
       'Pidgeot es un Pokémon del tipo normal/volador introducido en la primera generación. Es la forma evolucionada de Pidgeotto. A partir de Pokémon Rubí Omega y Pokémon Zafiro Alfa puede megaevolucionar en Mega-Pidgeot.');

insert into pokemon (numero,nombre,tipo1,tipo2,descripcion)
values(149,'dragonite', 4, 17,
       'Dragonite es un Pokémon de tipo dragón/volador introducido en la primera generación. Es la evolución de Dragonair.');

insert into pokemon (numero,nombre,tipo1,tipo2,descripcion)
values(103,'exeggutor', 12, 13,
       'Exeggutor es un Pokémon de tipo planta/psíquico introducido en la primera generación. Es la forma habitual del Exeggutor de Alola. En ambas variantes, es la evolución de Exeggcute.');