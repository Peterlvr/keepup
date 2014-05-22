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
  nm_fb varchar(50),
  tx_url_linkedin text,
  tx_url_externo text,
  nm_profissao varchar(50),
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
  tx_info text,
  tx_endereco varchar(150),
  tx_contato text,
  tx_url_externo text,
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
create table matricula_escola_n_registrada (
  cd_matricula tinyint not null auto_increment,
  cd_aluno int not null,
  nm_escola varchar(100) not null,
  primary key (
    cd_matricula,
    cd_aluno
  )
);
create table corpo_docente (
  cd_corpo_docente int not null auto_increment,
  constraint pk_corpo_docente
    primary key (
      cd_corpo_docente
    ),
  cd_escola int not null,
  constraint fk_corpodocente_escola
    foreign key (cd_escola)
      references escola (cd_escola),
  nm_corpo_docente varchar(150)
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
create table autoria_n_registrada (
  cd_trabalho int not null,
  cd_autoria tinyint not null auto_increment,
  nm_autor varchar(50),
  constraint pk_autoria_n_registrada
    primary key (
      cd_trabalho,
      cd_autoria
    )
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
create table voto (
  cd_trabalho int,
  cd_aluno int,
  constraint pk_voto
    primary key (
      cd_trabalho,
      cd_aluno
    ),
  vl_voto tinyint(5)
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
  (null, "S&atilde;o Vicente", "SP");

insert into area values
  (1, "Exatas"),
  (2, "Humanas"),
  (3, "Biol&oacute;gicas");

insert into curso values
  (null, "Inform&aacute;tica", 1, 1),
  (null, "Ci&ecirc;ncia da Computa&ccedil;&atilde;o", 2, 1),
  (null, "Sistemas de Informa&ccedil;&atilde;o", 2, 1),
  (null, "Jornalismo", 2, 2),
  (null, "M&uacute;sica", 2, 2),
  (null, "Letras", 2, 2),
  (null, "Enfermagem", 1, 3),
  (null, "Veterin&aacute;ria", 2, 3),
  (null, "Medicina", 2, 3);

# Usuários para teste
  # escola : escola22
  # aluno : aluno22

insert into usuario values
  (1, 'escola', '$2a$10$PpJkjRq5Q0JPD1jlD/TRauaHv5uU/U4a5FY5o4wAyGri1zBGwSOeq', 'escola@exemplo.com', 'E', '2014-05-16', '2014-05-16 18:59:48'),
  (2, 'aluno', '$2a$10$gAc9Ps06v3Mo.yIFUDUkOerQisyqKybysOs93gy7af0vawqS90vA2', 'aluno@exemplo.com', 'A', '2014-05-16', '2014-05-16 19:01:31');

insert into aluno values
  (1, 2, 'Aluno (teste)', '1990-01-01', '', '', '', '', '', '', 2);

insert into escola values
  (1, 1, 'Escola (teste)', '12345678901234', '', '', '', '', '', 1);

insert into cursando values
  (1, 1, 1);