
CREATE TABLE propietarios(
  id INT NOT NULL AUTO_INCREMENT,
  nombres VARCHAR(30) NOT NULL,
  apellidos VARCHAR(30) NOT NULL,
  fecha_nacimiento DATE NOT NULL,
  genero CHAR(1) NOT NULL,
  telefono VARCHAR(8) NOT NULL,
  email VARCHAR(30) NOT NULL,

  PRIMARY KEY (id)
);

CREATE TABLE inmuebles (
    id INT NOT NULL AUTO_INCREMENT,
    departamento VARCHAR(30) NOT NULL,
    municipio VARCHAR(30) NOT NULL,
    residencia VARCHAR(30) NOT NULL,
    calle VARCHAR(30) NOT NULL,
    poligono VARCHAR(15) NOT NULL,
    numero_casa INT NOT NULL,
    id_propietario INT NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (id_propietario) REFERENCES propietarios(id)
);
