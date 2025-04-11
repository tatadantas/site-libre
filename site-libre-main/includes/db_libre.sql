create database db_libre;

use db_libre;

CREATE TABLE if not exists usuarios
(
 id_usuario       		 int NOT NULL AUTO_INCREMENT ,
 email_usuario     		 varchar(60) unique NOT NULL ,
 senha_usuario    		 varchar(20) NOT NULL ,
 apelido_usuario         varchar(120) NOT NULL ,
 username_usuario        varchar(20) unique NOT NULL ,
 telefone_usuario        varchar(20) NOT NULL ,
 data_nasc_usuario       date NOT NULL ,
 data_cadas_usuario      datetime default now() NOT NULL ,

PRIMARY KEY (id_usuario)
)engine=innodb; 

CREATE TABLE if not exists vitrines
(
 id_vitrine             int NOT NULL AUTO_INCREMENT ,
 nome_vitrine           varchar(120) NOT NULL ,
 autor_vitrine          varchar(120) NOT NULL ,
 data_vitrine           datetime ,
 data_cadastro_vitrine  datetime default now() NOT NULL ,
 descricao_vitrine      varchar(300) default "sem descrição" NOT NULL ,
 ISBN_vitrine           int ,
 favoritos_vitrine      int default 0 not null ,
 like_vitrine           int default 0 not null ,
 deslike_vitrine        int default 0 not null ,
 
PRIMARY KEY (id_vitrine)  
)engine=innodb;  

CREATE TABLE if not exists usuarios_adm
(
 id_usuario_adm       		  int NOT NULL AUTO_INCREMENT ,
 email_usuario_adm     	      varchar(60) unique NOT NULL ,
 senha_usuario_adm     		  varchar(20) NOT NULL ,
 apelido_usuario_adm          varchar(120) NOT NULL ,
 username_usuario_adm         varchar(20) unique NOT NULL ,
 telefone_usuario_adm         varchar(20) NOT NULL ,
 data_nasc_usuario_adm        date NOT NULL ,
 data_cadas_usuario_adm       datetime default now() NOT NULL ,

PRIMARY KEY (id_usuario_adm)
)engine=innodb;

CREATE TABLE if not exists generos
(
 id_genero int NOT NULL AUTO_INCREMENT ,
 genero    varchar(60) unique NOT NULL ,

PRIMARY KEY (id_genero)
)engine=innodb; 

CREATE TABLE if not exists perfis
(
 id_perfil        int NOT NULL AUTO_INCREMENT ,
 id_usuario       int NOT NULL unique ,
 descricao_perfil varchar(300) default "sem descrição" NOT NULL ,
 foto_perfil      longtext NOT NULL ,
 username_perfil  varchar(20) unique NOT NULL ,
 banner_perfil    longtext NOT NULL ,

PRIMARY KEY (id_perfil),
CONSTRAINT FK_1 FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
)engine=innodb; 

CREATE TABLE if not exists perfis_adm
(
 id_perfil_adm        int NOT NULL AUTO_INCREMENT ,
 id_usuario_adm       int NOT NULL unique ,
 descricao_perfil_adm varchar(300) default "sem descrição" NOT NULL ,
 foto_perfil_adm      longtext NOT NULL ,
 username_perfil_adm  varchar(20) unique NOT NULL ,
 banner_perfil_adm    longtext NOT NULL ,

PRIMARY KEY (id_perfil_adm),
CONSTRAINT FK_1_1 FOREIGN KEY (id_usuario_adm) REFERENCES usuarios_adm (id_usuario_adm)
)engine=innodb;  

CREATE TABLE if not exists livros
(
 id_livro            int NOT NULL AUTO_INCREMENT ,
 id_perfil           int NOT NULL ,
 nome_livro          varchar(120) NOT NULL ,
 autor_livro         varchar(120) NOT NULL ,
 data_livro          datetime ,
 data_cadastro_livro datetime default now() NOT NULL ,
 descricao_livro     varchar(300) default "sem descrição" NOT NULL ,
 caminho_livro       longblob NOT NULL ,
 ISBN_livro          int ,
 favoritos_livro     int default 0 not null,
 like_livro          int default 0 not null,
 deslike_livro       int default 0 not null,
 

PRIMARY KEY (id_livro),
CONSTRAINT FK_2 FOREIGN KEY (id_perfil) REFERENCES perfis (id_perfil)
)engine=innodb;

create table if not exists posts
(
id_post         int auto_increment not null,
id_perfil       int not null, 
descricao_post  varchar(400), 
imagem_post     blob,
data_post       datetime default now(),
like_post       int default 0 not null,
deslike_post    int default 0 not null,

primary key (id_post),
constraint FK_3 foreign key (id_perfil) references perfis(id_perfil) 
)engine=innodb;
  
create table if not exists temas
(
id_tema   int not null auto_increment,
id_perfil int not null,
tema      enum('claro', 'esuro', 'do dispositivo'),

primary key(id_tema),
constraint FK_4 foreign key (id_perfil) references perfis (id_perfil)
)engine=innodb;

CREATE TABLE if not exists comentarios
(
id_comentario        int NOT NULL AUTO_INCREMENT ,
id_post              int NOT NULL ,
id_perfil            int NOT NULL ,
data_comentario      datetime default now() NOT NULL ,
descricao_comentario varchar(400) ,
like_comentario      int default 0 not null,
deslike_comentario   int default 0 not null,

PRIMARY KEY (id_comentario),
CONSTRAINT FK_5 FOREIGN KEY (id_post) REFERENCES posts (id_post),
CONSTRAINT FK_6 FOREIGN KEY (id_perfil) REFERENCES perfis (id_perfil)
)engine=innodb;  

CREATE TABLE if not exists progressos
(
 id_progresso          int NOT NULL AUTO_INCREMENT ,
 id_livro              int NOT NULL ,
 id_perfil             int NOT NULL ,
 data_inicio_progresso datetime default current_timestamp NOT NULL ,
 progresso             decimal(5,2) default 0.00 NOT NULL ,

PRIMARY KEY (id_progresso),
CONSTRAINT FK_7 FOREIGN KEY (id_livro) REFERENCES livros (id_livro),
CONSTRAINT FK_8 FOREIGN KEY (id_perfil) REFERENCES perfis (id_perfil)
)engine=innodb;  

CREATE TABLE if not exists favoritos
(
 id_favorito   int NOT NULL AUTO_INCREMENT ,
 id_vitrine    int ,
 id_livro      int ,
 id_perfil     int NOT NULL ,
 data_favorito datetime default now() NOT NULL ,

PRIMARY KEY (id_favorito),
CONSTRAINT FK_9 FOREIGN KEY (id_livro) REFERENCES livros (id_livro),
CONSTRAINT FK_9_1 FOREIGN KEY (id_vitrine) REFERENCES vitrines (id_vitrine),
CONSTRAINT FK_10 FOREIGN KEY (id_perfil) REFERENCES perfis (id_perfil)
)engine=innodb;

CREATE TABLE if not exists avaliacoes
(
id_avaliacao        int auto_increment not null,
id_usuario          int not null,
id_livro            int not null,
data_avaliacao      datetime default now() NOT NULL,
nota_avaliacao      int not null,
descricao_avaliacao varchar(400),
like_avaliacao      int default 0 not null,
deslike_avaliacao   int default 0 not null,
util_avaliacao      int default 0 not null,
nao_util_avaliacao  int default 0 not null,

primary key(id_avaliacao),
CONSTRAINT FK_11 FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
CONSTRAINT FK_12 FOREIGN KEY (id_livro) REFERENCES livros (id_livro)
)engine=innodb;

create table if not exists comentario_comentarios
(
id_coment_coment        int auto_increment not null,
id_comentario           int,
id_perfil              int,
descricao_coment_coment varchar(400),
data_coment_coment      datetime default now() NOT NULL ,
like_coment_coment      int default 0 not null,
deslike_coment_coment   int default 0 not null,

primary key(id_coment_coment),
CONSTRAINT FK_13 FOREIGN KEY (id_comentario) REFERENCES comentarios (id_comentario),
CONSTRAINT FK_14 FOREIGN KEY (id_perfil) REFERENCES perfis (id_perfil)
)engine=innodb;

CREATE TABLE if not exists preferencias
(
 id_preferencia int not null ,
 id_genero      int NOT NULL ,
 id_perfil      int NOT NULL ,

primary key(id_preferencia),
CONSTRAINT FK_17 FOREIGN KEY (id_perfil) REFERENCES perfis (id_perfil),
CONSTRAINT FK_18 FOREIGN KEY (id_genero) REFERENCES generos (id_genero)
)engine=innodb;                

CREATE TABLE if not exists amizades
(
 id_amizade     int NOT NULL AUTO_INCREMENT ,
 id_usuario     int NOT NULL ,
 id_perfil      int NOT NULL ,
 data_amizade   datetime default now() NOT NULL ,
 status_amizade enum('pendente', 'aceita', 'bloqueada') NOT NULL , 
 
PRIMARY KEY (id_amizade),
CONSTRAINT FK_19 FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
CONSTRAINT FK_20 FOREIGN KEY (id_perfil) REFERENCES perfis (id_perfil),
CONSTRAINT unq_amizade UNIQUE (id_usuario, id_perfil)
)engine=innodb; 

create table if not exists comentario_avaliacoes
(
id_coment_avalia        int auto_increment not null,
id_avaliacao            int not null,
id_usuario              int not null,
descricao_coment_avalia varchar(400) not null,
like_coment_avalia      int default 0 not null,
deslike_coment_avalia   int default 0 not null,


primary key(id_coment_avalia),
CONSTRAINT FK_21 FOREIGN KEY (id_avaliacao) REFERENCES avaliacoes (id_avaliacao),
CONSTRAINT FK_22 FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
)engine=innodb;

CREATE TABLE if not exists livro_generos
(
 id_livro_genero int not null auto_increment ,
 id_genero int NOT NULL ,
 id_livro  int NOT NULL ,

primary key(id_livro_genero),
CONSTRAINT FK_15 FOREIGN KEY (id_livro) REFERENCES livros (id_livro),
CONSTRAINT FK_16 FOREIGN KEY (id_genero) REFERENCES generos (id_genero)
)engine=innodb;      

create table if not exists likes
(
id_perfil  int,
id_livro   int,
id_vitrine int,

constraint FK_23 foreign key (id_perfil) references perfis (id_perfil),
constraint FK_24 foreign key (id_livro) references livros (id_livro),
constraint FK_25 foreign key (id_vitrine) references vitrines (id_vitrine)
)engine=innodb;

drop database db_libre;