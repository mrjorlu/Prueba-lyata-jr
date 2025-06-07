<template>
  <div class="max-w-4xl mx-auto p-6">
  <h1 class="text-3xl md:text-4xl font-bold mb-6 text-purple-900">
    🏠 Misión: Casitas Númericas
  </h1>
  <!-- Descripción del problema -->
  <div class="bg-pink-50 border-l-4 border-pink-500 p-4 mb-8 rounded-r-lg">
    <p class="text-gray-700 mb-2">
      <span class="font-bold text-pink-600">¡Ronroneos de ayuda!</span> Ayuda a los gatos a construir sus casitas (direcciones IP válidas) con sus juguetes numéricos.
    </p>
    <ul class="list-disc pl-5 text-gray-700 space-y-1">
      <li>4 casitas separadas por puntos (.)</li>
      <li>Cada casita debe tener entre 0 y 255 juguetes</li>
      <li>No puede empezar con '0' a menos que sea solo '0'</li>
      <li>¡No puedes cambiar el orden de los juguetes!</li>
    </ul>
  </div>
  <!-- Área de entrada -->
  <div class="mb-8">
    <label for="juguetesInput" class="block text-lg font-medium text-gray-700 mb-2">
      Introduce la cadena de juguetes:
    </label>
    <div class="flex gap-2">
      <input type="text" id="juguetesInput" v-model="cadenaJuguetes" placeholder="Ej: 25525511135" class="flex-1 px-4 py-3 rounded-lg border-2 border-purple-200 focus:border-pink-500 focus:ring-pink-500 text-lg" />
      <button class="cursor-pointer bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-6 rounded-lg shadow transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:hover:scale-100" @click="construirCasitas" :disabled="!isFormValid || isLoading">
        <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" v-if="isLoading">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span v-else>¡Construir Casitas!</span>
      </button>
    </div>
  </div>

  <!-- Resultados -->
  <div>
    <h2 class="text-2xl font-semibold text-purple-800 mb-4 flex items-center gap-2">
      <span class="text-3xl">🐾</span> Direcciones IP Gatunas Encontradas
    </h2>  
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-purple-100">
      <!-- Listado de IPs válidas -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden border border-purple-100" v-if="ipGatunas.length > 0">
        <div class="divide-y divide-purple-100 max-h-96 overflow-y-auto">
          <!-- Cada IP válida -->
          <div class="p-4 hover:bg-pink-50 transition-colors flex justify-between items-center" v-for="(ip, idx) in ipGatunas" :key="idx">
            <span class="font-mono text-lg">{{ ip }}</span>
            <button class="text-pink-500 hover:text-pink-700 p-1 rounded-full hover:bg-pink-100 cursor-pointer" @click="copiarIp(idx)">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
              </svg>
            </button>
          </div>
        </div>
      </div>
      <!-- no hay datos -->
      <div class="text-center p-8 bg-gradient-to-r from-purple-50 to-pink-50" v-else>
        <div class="text-5xl mb-4">😺</div>
        <p class="text-gray-600">Introduce una cadena de juguetes y haz click en <span class="font-bold text-pink-600">"Construir Casitas"</span> para ver las posibles direcciones IP gatunas.</p>
      </div> 
    </div>
    
    <!-- Contador de resultados -->
    <div class="mt-4 text-right">
      <span class="inline-block bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm font-medium">
        🐱 <span id="resultCount">{{ ipGatunas.length }}</span> direcciones encontradas
      </span>
    </div>
  </div>
  
  <!-- Botón de volver -->
  <div class="mt-12 text-center">
    <router-link to="/" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-purple-600 hover:bg-purple-700 transition-all transform hover:scale-105">
      ← Volver a Misiones Gatunas
    </router-link>
  </div>
</div>
</template>

<script setup>
  import {ref, computed} from 'vue';
  import api from '@/services/api.js';
  //obtener los datos de el input
  const cadenaJuguetes  = ref('');
  const ipGatunas       = ref([]);
  const isLoading       = ref(false);
  //peticion
  const construirCasitas = async () => {
    try{
      isLoading.value = true;
      const response = await api.post('/construir-casitas',{
        cadenaJuguetes: cadenaJuguetes.value
      });
      ipGatunas.value = response.data.ipGatunas;
    }catch(error){
      console.error('Error: ', error);
      alert ('Intentalo nuevamente');
    }finally{
      isLoading.value = false;
    }
  }
  const isFormValid = computed(() => {
    return (
      /^\d{1,20}$/.test(cadenaJuguetes.value)
    );
  });
  const copiarIp = async (idx) => {
  try {
    await navigator.clipboard.writeText(ipGatunas.value[idx]);
    alert('se ha copiado la ip');
  } catch (err) {
    console.error("Error al copiar:", err);
  }
};
</script>