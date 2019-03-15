CREATE DATABASE bddirectorioweb CHARACTER SET latin1 COLLATE latin1_spanish_ci;
/*despues usar la base de datos e insertar los valores*/

create table usuario(
    usuario_id int auto_increment primary key,
    usuario_nom varchar(50) not null,
    usuario_ape varchar(50) not null,
    usuario_doc varchar(15) UNIQUE,
    usuario_tel1 varchar(12) not null,
    usuario_otros_tel ENUM ('si','no') default "no" not null,
    usuario_email varchar(30) UNIQUE not null,
    usuario_contrasena varchar(20) not null,
    usuario_foto varchar(150),
    usuario_permiso varchar(1) default "3" not null
);
create table empresa(
    empresa_nit int(12) primary key,
    empresa_nom varchar(100) not null,
    empresa_dir varchar(100) not null,
    empresa_tel1 varchar(12) not null, 
    empresa_otros_tel ENUM ('si','no') default "no" not null,    
    empresa_email varchar(100) UNIQUE not null,
    empresa_nom_contac varchar(30) not null,
    empresa_pagina varchar(30),
    empresa_antig int(3),      
    empresa_fact_anual float(12),
    empresa_num_empl int(4),
    empresa_contrasena varchar(20) not null,
    empresa_foto varchar(150),
    empresa_permiso varchar(1) default "2" not null,
    empresa_fecha date     
);

create table producto(
    producto_cod int(6) auto_increment primary key,
    empresa_nit int(12) not null,
    foreign key (empresa_nit) REFERENCES empresa (empresa_nit),
    producto_nom varchar(50) not null,
    producto_tipo varchar(20) not null,
    producto_descrip varchar(150),
    producto_precio decimal(19,3),
    producto_stock ENUM ('si','no') default "si",
    product_cant_min_venta int(4),
    producto_envia_muestras ENUM ('si','no') default "no",
    producto_foto varchar(150) default "logo_de_producto.png",
    producto_fecha date
);
create table servicio(
    servicio_cod int auto_increment primary key,
    empresa_nit int(12) not null,
    foreign key (empresa_nit) references empresa (empresa_nit),
    servicio_nom varchar(50) not null,
    servicio_tipo varchar(50) not null, 
    servicio_mobra decimal(19,3),
    servicio_comenta varchar(150) not null,
    servicio_foto varchar(150) default "logo_de_servicio.png",
    servicio_fecha date
);

create table valoracionproducto (
    valoracionproducto_cod int auto_increment primary key,
    producto_cod int(6) not null,
    foreign key (producto_cod) references producto(producto_cod),
    usuario_id int(6) not null,
    foreign key (usuario_id) references usuario(usuario_id),
    valoracionproducto_fecha date not null,
    valoracionproducto_calificacion int(3) not null,
    valoracionproducto_comenta varchar(150) not null
);
create table valoracionservicio (
    valoracionservicio_cod int auto_increment primary key,
    servicio_cod int(6) not null,
    foreign key (servicio_cod) references servicio(servicio_cod),
    usuario_id int(6) not null,
    foreign key (usuario_id) references usuario(usuario_id),
    valoracionservicio_fecha date not null,
    valoracionservicio_calificacion int(3) not null,
    valoracionservicio_comenta varchar(150) not null
);
create table consulta_usuario_Producto(
    consultas_id int auto_increment primary key,
    fecha date not null,
    empresa_nit int(12) not null,
    foreign key (empresa_nit) references empresa (empresa_nit),
    usuario_id int(6) not null,
    foreign key (usuario_id) references usuario (usuario_id),
    consulta varchar(150) not null,
    producto_cod int(12) not null,
    foreign key (producto_cod) references producto (producto_cod)
);
create table consulta_usuario_Servicio(
    consultas_id int auto_increment primary key,
    fecha date not null,
    empresa_nit int(12) not null,
    foreign key (empresa_nit) references empresa (empresa_nit),
    usuario_id int(6) not null,
    foreign key (usuario_id) references usuario (usuario_id),
    consulta varchar(150) not null,
    servicio_cod int(12) not null,
    foreign key (servicio_cod) references servicio (servicio_cod)
);
create table consulta_usuario_Empresa(
    consultas_id int auto_increment primary key,
    fecha date not null,
    empresa_nit int(12) not null,
    foreign key (empresa_nit) references empresa (empresa_nit),
    usuario_id int(6) not null,
    foreign key (usuario_id) references usuario (usuario_id),
    consulta varchar(150) not null
);

create table consulta_empresa_producto(
    consultas_id int auto_increment primary key,
    fecha date not null,
    empresa_nit int(12) not null,
    foreign key (empresa_nit) references empresa (empresa_nit),
    empresa_nit_consultante int(12) not null,
    foreign key (empresa_nit_consultante) references empresa (empresa_nit), 
    consulta varchar(150) not null,
    producto_cod int(12) not null,
    foreign key (producto_cod) references producto (producto_cod)
);
create table consulta_empresa_servicio(
    consultas_id int auto_increment primary key,
    fecha date not null,
    empresa_nit int(12) not null,
    foreign key (empresa_nit) references empresa (empresa_nit),
    empresa_nit_consultante int(12) not null,
    foreign key (empresa_nit_consultante) references empresa (empresa_nit), 
    consulta varchar(150) not null,
    servicio_cod int(12) not null,
    foreign key (servicio_cod) references servicio (servicio_cod)
);

create table telsusuario(
    telsusuario_id int auto_increment primary key, 
    usuario_id int(6) not null,
    foreign key (usuario_id) references usuario(usuario_id),
    telsusuario_otros varchar(12)    
    );
create table telsempresa(
    telsempresa_id int auto_increment primary key, 
    empresa_nit int(12) not null,
    foreign key (empresa_nit) references empresa(empresa_nit),
    telsempresa_otros varchar(12)
);
create table certificacion(
    certificacion_id int auto_increment primary key,
    certificacion_nom varchar(20) not null,
    certificacion_especif varchar(80)    
);

insert into certificacion values
    (null,'NINGUNA',null),
    (null,'ISO',null),
    (null,'ICONTEC',null),
    (null,'BPM',null);

create table cert_estado(
    cert_cod int auto_increment primary key,
    certificacion_estado_nom varchar(20) not null
);

/*Inserta los valores para definir la certificación*/

INSERT INTO cert_estado values
    (default,'Certificada'),
    (default,'En tramite'),
    (default,'No certificada')
;

create table certificacionempresa(
    certificacionempresa_id int(6) auto_increment primary key,
    empresa_nit int(12) UNIQUE not null,
    foreign key (empresa_nit) references empresa(empresa_nit),
    certificacion_id int(6) not null,
    foreign key (certificacion_id) references certificacion(certificacion_id),
    certificacionempresa_estado int(2) DEFAULT 1 NOT NULL,
    foreign key (certificacionempresa_estado) references cert_estado(cert_cod)
);

/*lleva las empresas directamente a la tabla 
certificación para darles el valor por defecto no certificadas*/
CREATE TRIGGER empresa_AI AFTER INSERT ON empresa
 FOR EACH ROW INSERT INTO
    certificacionempresa(
    certificacionempresa_id,
    empresa_nit,
    certificacion_id,
    certificacionempresa_estado)
VALUES(DEFAULT,NEW.empresa_nit,1,3);


create table pqrusuario (
    pqrusuario_id int auto_increment primary key,
    usuario_id int(6) not null,
    foreign key (usuario_id) references usuario(usuario_id),
    pqrusuario_motivo varchar(150) not null,
    pqrusuario_descrip varchar(300) not null
);

create table pqrempresa (
    pqrempresa_id int auto_increment primary key,
    empresa_nit int(12) not null,
    foreign key (empresa_nit) references empresa(empresa_nit),
    pqrempresa_motivo varchar(150) not null,
    pqrempresa_descrip varchar(300) not null
);

create table permiso(
    permiso_id int auto_increment primary key,
    usuario_rol varchar(20) not null,
    permiso_descrip varchar(50)    
);

/*AGREGA INDICES DE BÚSQUEDA A LAS TABLAS*/

ALTER TABLE bddirectorioweb.empresa ADD FULLTEXT busFTempresa (empresa_nom);

ALTER TABLE bddirectorioweb.producto ADD FULLTEXT busFTproducto (producto_nom,producto_descrip);

ALTER TABLE bddirectorioweb.servicio ADD FULLTEXT busFTservicio (servicio_nom,servicio_tipo,servicio_comenta);

