<template>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl md:text-4xl font-bold mb-6 text-purple-900">💤 Misión: Siesta Felina</h1>
        <!-- Descripción del problema -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded-r-lg">
            <p class="text-gray-700 mb-2">
                <span class="font-bold text-blue-600">¡Ronroneos matemáticos!</span> Encuentra la secuencia más larga de números de collar consecutivos.
            </p>
            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                <li>Los gatos están desordenados inicialmente</li>
                <li>Debes encontrar la secuencia consecutiva más larga</li>
                <li>La solución debe ser eficiente (O(n))</li>
                <li>¡No puedes ordenar el arreglo completo!</li>
            </ul>
        </div>
        <!-- Input y boton de ejecutar -->
        <div class="mb-8">
            <label for="collaresInput" class="block text-lg font-medium text-gray-700 mb-2">Introduce los números de collar (separados por comas):</label>
            <div class="flex gap-2">
                <input type="text" id="collaresInput" placeholder="Ej: 100, 4, 200, 1, 3, 2" class="flex-1 px-4 py-3 rounded-lg border-2 border-blue-200 focus:border-blue-500 focus:ring-blue-500 text-lg" v-model="collares"/>
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow transition-all transform hover:scale-105 disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none disabled:hover:scale-100 disabled:hover:bg-blue-600" @click="longitudSiesta" :disabled="arrayCollares.length === 0 || isLoading">
                    <svg class="animate-spin h-5 w-5 text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" v-if="isLoading">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span v-else>¡Encontrar Siesta!</span>
                </button>    
            </div>
        </div>
        <!-- Vizualización de el array -->
        <div class="mb-8 bg-white p-4 rounded-lg shadow border border-blue-100">
            <h3 class="text-lg font-medium text-blue-800 mb-3">Gatos en el patio:</h3>
            <div class="flex flex-wrap gap-2 min-h-12" id="collaresVisualization">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800" v-for="(collar, idx) in arrayCollares" :key="idx">{{ collar }}</span>     
            </div>
        </div>
        <!-- Resultado -->
        <div>
            <h2 class="text-2xl font-semibold text-purple-800 mb-4 flex items-center gap-2"><span class="text-3xl">😴</span> Resultado de la Siesta Felina</h2>
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-blue-100 p-6">
                <div class="text-center" >
                    <div class="text-5xl mb-4">🐱</div>
                    <p class="text-gray-600">Introduce los números de collar y haz click en <span class="font-bold text-blue-600">"Encontrar Siesta"</span> para descubrir la secuencia consecutiva más larga.</p>
                </div>
                <div class="">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Longitud de la siesta más larga:</p>
                            <p class="text-4xl font-bold text-blue-600">{{ secuencia }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                </div>
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
    const collares      = ref('');
    const isLoading     = ref(false);
    const secuencia     = ref(0);
    //actualiza arrayCollares basado en el input y solamente toma numeros enteros
    const arrayCollares = computed(() => {
        if(!collares.value.trim()) return [];
        const numerosLimpios = new Set(
            collares.value.split(',').map(num => num.trim()).filter(num => num !== "" && !isNaN(num) && Number.isInteger(Number(num))).map(num => Number(num))
        );
        return Array.from(numerosLimpios);
    });
    //peticion 
    const longitudSiesta = async () => {
        try{
            isLoading.value = true;
            const response = await api.post('/secuencia-siesta',{
                collares: arrayCollares.value
            });
            secuencia.value = response.data.secuencia;
        }catch(error){
            console.error('Error: ', error);
            alert ('Intentalo nuevamente');
        }finally{
            isLoading.value = false;
        }
    }
</script>