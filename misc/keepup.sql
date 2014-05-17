drop database if exists keepup;
create database keepup default character set UTF8;
use keepup;
create table usuario (
  cd_usuario int not null auto_increment,
  constraint pk_usuario
    primary key (
      cd_usuario
    ),
  nm_login varchar(30) not null unique,
  nm_senha char(60) not null,
  nm_email varchar(150) not null unique,
  nm_tipo char(1) not null,
  dt_criacao_conta date not null,
  dt_ultimo_acesso datetime not null
);
create table cidade (
  cd_cidade int not null auto_increment,
  nm_cidade varchar(100) not null,
  sg_estado varchar(2) not null,
  constraint pk_cidade
    primary key (
      cd_cidade
    )
);
create table aluno (
  cd_aluno int not null auto_increment,
  constraint pk_aluno
    primary key (
      cd_aluno
    ),
  cd_usuario int not null unique,
  constraint fk_alunousuario
    foreign key (cd_usuario)
      references usuario (cd_usuario),
  nm_aluno varchar(100) not null,
  dt_nascimento date not null,
  tx_bio text,
  nm_url_avatar text,
  cd_cidade int,
  constraint fk_alunocidade
    foreign key (cd_cidade)
      references cidade (cd_cidade)
);
create table escola (
  cd_escola int not null auto_increment,
  constraint pk_escola
    primary key (
      cd_escola
    ),
  cd_usuario int not null unique,
  constraint fk_escolausuario
    foreign key (cd_usuario)
      references usuario (cd_usuario),
  nm_escola varchar(300) not null,
  nm_cnpj char(14) not null unique,
  tx_url_avatar text,
  cd_cidade int,
  constraint fk_escolacidade
    foreign key (cd_cidade)
      references cidade (cd_cidade)
);
create table matricula (
  cd_aluno int not null,
  cd_escola int not null,
  constraint pk_alunoescola
    primary key (
      cd_aluno,
      cd_escola
    ),
  constraint fk_alunoescola_a
    foreign key (cd_aluno)
      references aluno (cd_aluno),
  constraint fk_alunoescola_e
    foreign key (cd_escola)
      references escola (cd_escola)
);
create table info_escola (
  cd_info int not null auto_increment,
  cd_escola int not null,
  constraint pk_info_escola
    primary key (
      cd_info,
      cd_escola
    ),
  constraint fk_info_escola
    foreign key (cd_escola)
      references escola (cd_escola),
  nm_titulo varchar(200) not null,
  tx_info text not null
);
create table area (
  cd_area int not null auto_increment,
  constraint pk_area
    primary key (
      cd_area
    ),
  nm_area varchar(45) not null
);
create table curso (
  cd_curso int not null auto_increment,
  constraint pk_curso
    primary key (
      cd_curso
    ),
  nm_curso varchar(100) not null unique,
  vl_nivel tinyint not null,
  cd_area int not null,
  constraint fk_curso_area
    foreign key (cd_area)
      references area (cd_area)
);
create table curso_oferecido (
  cd_escola int not null,
  cd_curso int not null,
  constraint pk_cursoescola
    primary key (
      cd_escola,
      cd_curso
    ),
  constraint fk_cursoescola_c
    foreign key (cd_curso)
      references curso (cd_curso),
  constraint fk_cursoescola_e
    foreign key (cd_escola)
      references escola (cd_escola)
);
create table cursando (
  cd_aluno int not null,
  cd_curso int not null,
  constraint pk_alunocurso
    primary key (
      cd_aluno,
      cd_curso
    ),
  constraint fk_alunocurso_a
    foreign key (cd_aluno)
      references aluno (cd_aluno),
  constraint fk_alunocurso_c
    foreign key (cd_curso)
      references curso (cd_curso),
  bl_concluido bool not null
);
create table trabalho (
  cd_trabalho int not null auto_increment,
  constraint pk_trabalho
    primary key (
      cd_trabalho
    ),
  nm_titulo varchar(200) not null,
  ds_resumo text,
  cd_escola int not null,
  cd_curso int not null,
  constraint fk_trabalhoescola
    foreign key (cd_escola)
      references escola (cd_escola),
  constraint fk_trabalhocurso
    foreign key (cd_curso)
      references curso (cd_curso),
  dt_publicado datetime not null,
  aa_publicacao int(4) not null
);
create table arquivo (
  cd_arquivo int not null auto_increment,
  cd_trabalho int not null,
  constraint pk_arquivo
    primary key (
      cd_arquivo,
      cd_trabalho
    ),
  constraint fk_arquivotrabalho
    foreign key (cd_trabalho)
      references trabalho (cd_trabalho),
  nm_arquivo varchar(100),
  nm_url text not null
);
create table autoria (
  cd_aluno int not null,
  cd_trabalho int not null,
  constraint pk_alunotrabalho
    primary key (
      cd_aluno,
      cd_trabalho
    ),
  constraint fk_alunotrabalho_a
    foreign key (cd_aluno)
      references aluno (cd_aluno),
  constraint fk_alunotrabalho_t
    foreign key (cd_trabalho)
      references trabalho (cd_trabalho)
);
create table favorito (
  cd_aluno int not null,
  cd_trabalho int not null,
  constraint pk_favorito
    primary key (
      cd_aluno,
      cd_trabalho
    ),
  constraint fk_favaluno
    foreign key (cd_aluno)
      references aluno (cd_aluno),
  constraint fk_favtrabalho
    foreign key (cd_trabalho)
      references trabalho (cd_trabalho),
  dt_favoritado datetime not null
);
create table comentario (
  cd_comentario int not null auto_increment,
  constraint pk_comentario
    primary key (
      cd_comentario
    ),
  tx_comentario text not null,
  cd_autor int not null,
  constraint fk_autor
    foreign key (cd_autor)
      references aluno (cd_aluno),
  cd_trabalho int not null,
  constraint fk_trabalho
    foreign key (cd_trabalho)
      references trabalho (cd_trabalho)
);
create table votocomentario (
  cd_aluno int not null,
  cd_comentario int not null,
  constraint pk_votocomentario
    primary key (
      cd_aluno,
      cd_comentario
    ),
  constraint fk_votocomentarioaluno
    foreign key (cd_aluno)
      references aluno (cd_aluno),
  constraint fk_votocomentariocomentario
    foreign key (cd_comentario)
      references comentario (cd_comentario),
  vl_voto tinyint not null
);
create table site_admin (
  cd_admin int not null auto_increment,
  constraint pk_admin
    primary key (
      cd_admin
    ),
  nm_login varchar(20) not null,
  nm_senha char(32) not null
);

insert into cidade values
  (null, "Santos", "SP"),
  (null, "São Vicente", "SP");

insert into area values
  (1, "Exatas"),
  (2, "Humanas"),
  (3, "Biológicas");

insert into curso values
  (null, "Informática", 1, 1),
  (null, "Ciência da Computação", 2, 1),
  (null, "Sistemas de Informação", 2, 1),
  (null, "Jornalismo", 2, 2),
  (null, "Música", 2, 2),
  (null, "Letras", 2, 2),
  (null, "Enfermagem", 1, 3),
  (null, "Veterinária", 2, 3),
  (null, "Medicina", 2, 3);