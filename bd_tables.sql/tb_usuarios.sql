CREATE TABLE tb_usuarios(

    id               INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombres          VARCHAR (255) null,
    email            VARCHAR (255) null,
    email_verificado VARCHAR (255) null,
    password_user    VARCHAR (255) null,
    token            VARCHAR (255) null,

    fec_creacion      DATETIME NULL,
    fec_actualizacion DATETIME NULL,
    fec_eliminacion   DATETIME NULL,
    estado            VARCHAR (10) 

);