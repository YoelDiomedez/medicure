# MediCure

Sistema para la gestión de Historiales Médicos

## Características del Sistema

**Módulo Admisión**
- [x] Dashboard
- [x] Pacientes
- [x] Historiales
- [x] Atenciones

**Módulo Clínica**
- [x] Triajes
- [x] Historias

**Módulo Informe**
- [x] Quirúrgicos
- [x] Laboratoriales

**Módulo Mantenimiento**
- [x] Accesos
- [x] Servicios
- [x] Diagnósticos
- [x] Especialistas

**Módulo Sistema**
- [x] Auditoria

## Despliegue

- WSL 2
- Docker Desktop

``` bash
# Enviroment
  cp .env.example .env

# Composer
  docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# Sail
  ./vendor/bin/sail up -d
  ./vendor/bin/sail npm install
  ./vendor/bin/sail npm run dev
  ./vendor/bin/sail php artisan key:generate
  ./vendor/bin/sail php artisan migrate --seed
```