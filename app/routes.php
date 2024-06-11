<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    // Rutas para propietarios
    $app->get('/propietarios[/{id}]', function (Request $request, Response $response, $args) {
        $db = $this->get('db');

        if (isset($args['id'])) {
            $stmt = $db->prepare('SELECT * FROM propietarios WHERE id = :id');
            $stmt->execute(['id' => $args['id']]);
            $propietario = $stmt->fetch();
            $result = $propietario ? [$propietario] : [];
        } else {
            $stmt = $db->query('SELECT * FROM propietarios');
            $result = $stmt->fetchAll();
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/propietarios', function (Request $request, Response $response) {
        $db = $this->get('db');
        $data = $request->getParsedBody();
        $stmt = $db->prepare('INSERT INTO propietarios (nombres, apellidos, fecha_nacimiento, genero, telefono, email) VALUES (:nombres, :apellidos, :fecha_nacimiento, :genero, :telefono, :email)');
        $stmt->execute([
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'genero' => $data['genero'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
        ]);
        $response->getBody()->write(json_encode(['id' => $db->lastInsertId()]));
        return $response->withHeader('Content-Type', 'application/json');
    });

    // Rutas para inmuebles
    $app->get('/inmuebles[/{id}]', function (Request $request, Response $response, $args) {
        $db = $this->get('db');

        if (isset($args['id'])) {
            $stmt = $db->prepare('SELECT * FROM inmuebles WHERE id = :id');
            $stmt->execute(['id' => $args['id']]);
            $inmueble = $stmt->fetch();
            $result = $inmueble ? [$inmueble] : [];
        } else {
            $stmt = $db->query('SELECT * FROM inmuebles');
            $result = $stmt->fetchAll();
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/inmuebles', function (Request $request, Response $response) {
        $db = $this->get('db');
        $data = $request->getParsedBody();
        $stmt = $db->prepare('INSERT INTO inmuebles (departamento, municipio, residencia, calle, poligono, numero_casa, id_propietario) VALUES (:departamento, :municipio, :residencia, :calle, :poligono, :numero_casa, :id_propietario)');
        $stmt->execute([
            'departamento' => $data['departamento'],
            'municipio' => $data['municipio'],
            'residencia' => $data['residencia'],
            'calle' => $data['calle'],
            'poligono' => $data['poligono'],
            'numero_casa' => $data['numero_casa'],
            'id_propietario' => $data['id_propietario'],
        ]);
        $response->getBody()->write(json_encode(['id' => $db->lastInsertId()]));
        return $response->withHeader('Content-Type', 'application/json');
    });
};
