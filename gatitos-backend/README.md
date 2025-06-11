# 🐾 Backend - Misiones Gatunas

Este backend está desarrollado con **Laravel 12** y proporciona una API RESTful que resuelve diversos desafíos lógicos relacionados con nuestros amigos felinos. Está diseñado para ser consumido por un frontend hecho en Vue.js.

## ⚙️ Requisitos

- PHP >= 8.2
- Composer >= 2.x
- MySQL >= 8.0

## 🚀 Instalación

1. Clona el repositorio y navega al directorio del backend:
   ```bash
   git clone https://github.com/tu-usuario/misiones-gatunas.git
   cd misiones-gatunas/backend
2. Instala las dependencias con Composer:
     ```bash
    composer install
3. Copia el archivo de configuración de entorno
   ```bash
    cp .env.example .env
4. Configura tus variables de entorno en .env (DB, etc.)
5. Genera la clave de la aplicación:
    ```bash
    php artisan key:generate
6. Ejecuta las migraciones:
   ```bash
   php artisan migrate
7. Ejecutar el servidor
   ```bash
   composer run dev o php artisan serve

## 🧩 Endpoints principales

| Método | Endpoint                 | Descripción                                                                 |
|--------|--------------------------|-----------------------------------------------------------------------------|
| POST   | `/api/construir-casitas` | Genera todas las direcciones IP válidas a partir de una cadena              |
| POST   | `/api/secuencia-siesta`  | Devuelve la longitud de la secuencia consecutiva más larga                 |
| POST   | `/api/desifrar-maullido` | Devuelve la palabra original y posibles combinaciones decodificadas        |
