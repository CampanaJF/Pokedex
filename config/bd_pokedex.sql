drop database if exists pokedex;
create database pokedex;
use pokedex;

create table pokemon(
id int auto_increment primary key,
numero int,
nombre varchar(20),
tipo1 varchar(20),
tipo2 varchar(20),
descripcion text,
img varchar(20)
);

drop table pokemon;
create table usuario(
id int auto_increment primary key,
nombre varchar (20),
contraseña varchar (40),
esAdmin int
);

insert into usuario (nombre,contraseña,esAdmin)
			 values("admin","admin",1);
             
insert into pokemon (numero,nombre,tipo1,tipo2,descripcion,img)
              values(094,"Gengar","Tipo_veneno.jepg","Tipo_fantasma.jpeg",
              "Gengar es un Pokémon de tipo fantasma/veneno introducido en la primera generación. Es la evolución de Haunter y,
              a partir de la sexta generación, puede megaevolucionar en Mega-Gengar. ","Gengar.jpeg");


insert into pokemon (numero,nombre,tipo1,tipo2,descripcion)
values(006,"Charizard","Tipo_fuego","Tipo_volador",
       "Charizard es un Pokémon de tipo fuego/volador, introducido en la primera generación. Es la evolución de Charmeleon y, a partir de la sexta generación, puede megaevolucionar en Mega-Charizard X o en Mega-Charizard Y. En la Octava generación puede realizar Gigamax y transformarse en Charizard Gigamax.");

insert into pokemon (numero,nombre,tipo1,tipo2,descripcion)
values(018,"pidgeot","Tipo_normal","Tipo_volador",
       "Pidgeot es un Pokémon del tipo normal/volador introducido en la primera generación. Es la forma evolucionada de Pidgeotto. A partir de Pokémon Rubí Omega y Pokémon Zafiro Alfa puede megaevolucionar en Mega-Pidgeot.");

insert into pokemon (numero,nombre,tipo1,tipo2,descripcion)
values(149,"dragonite","Tipo_dragon","Tipo_volador",
       "Dragonite es un Pokémon de tipo dragón/volador introducido en la primera generación. Es la evolución de Dragonair.");

insert into pokemon (numero,nombre,tipo1,tipo2,descripcion)
values(103,"exeggutor","Tipo_planta","Tipo_psiquico",
       "Exeggutor es un Pokémon de tipo planta/psíquico introducido en la primera generación. Es la forma habitual del Exeggutor de Alola. En ambas variantes, es la evolución de Exeggcute.");