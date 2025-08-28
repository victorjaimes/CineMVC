CREATE TABLE peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) UNIQUE NOT NULL,
    sinopsis TEXT,
    duracionMin INT NOT NULL,
    clasificacion VARCHAR(50),
    genero TEXT,
    estado VARCHAR(8) DEFAULT 'activo',
    fechaEstreno DATE,
    create_auditoria TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_auditoria TIMESTAMP NULL,
    delete_auditoria TIMESTAMP NULL
);

CREATE TABLE turnos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  peliculaId INT,
  sala INT,
  inicio DATETIME,
  fin DATETIME,
  precio DECIMAL(6,2),
  idioma VARCHAR(3),
  formato VARCHAR(2),
  aforo INT,
  estado VARCHAR(8) DEFAULT 'activo',
  create_auditoria TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  update_auditoria TIMESTAMP NULL,
  delete_auditoria TIMESTAMP NULL,
  FOREIGN KEY (peliculaId) REFERENCES peliculas(id)
);