# Medicure

Sistema de Información para la gestión de Historiales Médicos -> [Live Demo](https://medi-cure.herokuapp.com)

**Consideraciones:**

1. Habilitar las ventanas emergentes en el navegador para los reportes:

   - Laboratoriales
   - Operatorio-Quirúrgico
   - Historias Clínicas
   - Recetas Médicas

2. Instalar la extension Dark Reader para reducir el cansancio visual:

   - [Chrome](https://chrome.google.com/webstore/detail/dark-reader/eimadpbcbfnmbkopoojfekhnkhdbieeh)
   - [Firefox](https://addons.mozilla.org/en-US/firefox/addon/darkreader/)

3. CTRL + (+|-) para aumentar o reducir el tamaño de texto 

4. Agregar al archivo ENV

- PRINCE_SOURCE: Ubicación de los binarios de [Prince XML](https://www.princexml.com/download/)
- PRINCE_STORAGE: Ubicación o lugar donde se guardara los archivos de cache html

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
- [x] Auditorias

## Requerimiento para Despliegue

- PHP >= 7.1.3 (Composer)
- MariaDB >= 10.1.40

``` bash
# Instalación de Dependencias
  composer install

# Configuración de Variables de Entorno (archivo .env)
  DB_DATABASE=yourdatabasename
  DB_USERNAME=yourusername
  DB_PASSWORD=yoursecretpassword
  
# Migración de Base de Datos y Seeder
  php artisan migrate --seed | php artisan migrate:refresh --seed

# Optimización de Dependencias
  composer dump-autoload

# Lanzamiento del Servidor a traves de 
  XAMPP, Homestead o Laragon

```
