CREATE TABLE dispositivo (
  iddispositivo int NOT NULL AUTO_INCREMENT,
  so varchar(50) NULL,
  datacriacao datetime NULL,
  token varchar(255) NULL,
  fkusuario int NULL,
  PRIMARY KEY (iddispositivo),
  KEY fkusuario (fkusuario)
);

CREATE TABLE endereco (
  idendereco int NOT NULL AUTO_INCREMENT,
  idresidente int NULL,
  rua varchar(100) NOT NULL,
  bairro varchar(100) NOT NULL,
  cep varchar(9) NOT NULL,
  numero varchar(6) NOT NULL,
  foto varchar(50) NULL,
  PRIMARY KEY (idendereco),
  KEY idresidente (idresidente)
);

CREATE TABLE residente (
  idresidente int NOT NULL AUTO_INCREMENT,
  nome varchar(50) NOT NULL,
  idade char(2) NOT NULL,
  trabalho varchar(10) NOT NULL,
  telefone varchar(10) NOT NULL,
  qt_pessoas varchar(15) NOT NULL,
  PRIMARY KEY (idresidente)
);

CREATE TABLE saneamento (
  idsaneamento int NOT NULL AUTO_INCREMENT,
  idresidente int NOT NULL,
  agua_trat varchar(10) NOT NULL,
  col_lixo varchar(10) NOT NULL,
  casa_esgoto varchar(10) NOT NULL,
  PRIMARY KEY (idsaneamento),
  KEY idresidente (idresidente)
);


CREATE TABLE usuario (
  idusuario int NOT NULL AUTO_INCREMENT,
  nome varchar(50) NULL,
  email varchar(250) NULL,
  senha varchar(255) NULL,
  PRIMARY KEY (idusuario)
);

ALTER TABLE dispositivo
  ADD CONSTRAINT dispositivo FOREIGN KEY (fkusuario) REFERENCES usuario (idusuario);


