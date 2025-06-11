# 🐾 Frontend - Misiones Gatunas

Este es el frontend del proyecto **Misiones Gatunas**, desarrollado con **Vue 3** y **TailwindCSS**. Permite interactuar visualmente con la API que resuelve desafíos lógicos relacionados con nuestros amigos felinos.

---

## ⚙️ Tecnologías utilizadas

- **Framework**: Vue 3 (Vite)
- **Estilos**: TailwindCSS
- **Lenguaje**: JavaScript (ES6+)
- **Gestor de paquetes**: npm

---

## 📦 Requisitos previos

- Node.js >= 22.16.x
- npm >= 11.4.x

Puedes verificar tu versión con:
```bash
node -v
npm -v
```
# 🚀 Instalación paso a paso
1. Clona el repositorio y accede a la carpeta del frontend:
   ```bash
   git clone https://github.com/mrjorlu/Prueba-lyata-jr.git
   cd gatitos-frontend
2. Instala las dependencias del proyecto:
   ```bash
   npm install
3. Inicia el servidor de desarrollo:
   ```bash
   npm run dev
## ⚙️ Configuración de la API
La URL base del backend se encuentra definida en el archivo:
`src/services/api.js`
Ejemplo de configuración:
```javascript
// src/services/api.js
import axios from 'axios';
const api = axios.create({ 
    baseURL: 'http://127.0.0.1:8000/api',  // Cambia esta URL si el backend está en otro host/puerto
});
export default api;
```
