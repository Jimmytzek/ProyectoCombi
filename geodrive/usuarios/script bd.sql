create table usuarios(
  id int not null AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(20) not null,
  apellido varchar(20),
  email  varchar(20),
  clave varchar(20) not null
);