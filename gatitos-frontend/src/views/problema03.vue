<template>
    <div class="md:max-w-4xl md:mx-auto md:p-6">
        <h1 class="text-3xl md:text-4xl font-bold mb-6 text-purple-900">🕵️‍♂️ Misión: Maullido Secreto</h1>
        <!-- Descripción del problema -->
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded-r-lg">
            <p class="text-gray-700 mb-2">
                <span class="font-bold text-green-600">¡Desafío lingüístico felino!</span> Descifra el maullido misterioso usando palabras del diccionario gatuno.
            </p>
            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                <li>Inserta espacios para formar palabras válidas</li>
                <li>Puedes reutilizar palabras del diccionario</li>
                <li>El maullido solo contiene letras minúsculas</li>
                <li>¡Encuentra todas las combinaciones posibles!</li>
            </ul>
        </div>
        <!-- Área de entrada del maullido -->
        <div class="mb-1">
            <label for="maullidoInput" class="block text-lg font-medium text-gray-700 mb-2">Introduce el maullido misterioso:</label>
            <input type="text" id="maullidoInput" placeholder="Ej: catsanddog" v-model="v$.maullido.$model" class="w-full px-4 py-3 rounded-lg border-2 border-green-200 focus:border-green-500 focus:ring-green-500 text-lg font-mono" />
        </div>
        <!-- area para mostrar errores del maullido -->
        <div v-if="v$.maullido.$error" class="mt-1">
            <p class="text-red-600 text-sm flex items-center gap-1" v-if="v$.maullido.required.$invalid">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span id="error-message">El maullido es requerido</span>
            </p>
            <p class="text-red-600 text-sm flex items-center gap-1" v-if="v$.maullido.minLength.$invalid || v$.maullido.maxLength.$invalid">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span id="error-message">Debe contener entre 1 y 20 caracteres</span>
            </p>
            <p class="text-red-600 text-sm flex items-center gap-1" v-if="v$.maullido.alphaLower.$invalid">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span id="error-message">Solo se permiten letras minúsculas</span>
            </p>
        </div>
        <!-- Área de entrada del diccionario -->
        <div class="mb-8">
            <label for="diccionarioInput" class="block text-lg font-medium text-gray-700 mb-2">Diccionario felino (separado por comas):</label>
            <textarea id="diccionarioInput" rows="3" placeholder="Ej: cat,cats,and,sand,dog" v-model="diccionarioRaw" @blur="processDictionary" 
            class="w-full px-4 py-3 rounded-lg border-2 border-green-200 focus:border-green-500 focus:ring-green-500 text-lg font-mono"></textarea>
            <div>
                Palabras actuales: {{ diccionarioFelino.length }} / 1000
            </div>
            <!-- area para mostrar errores del diccionario -->
            <div v-if="v$.diccionarioFelino.$error"  class="mt-1">
                <p class="text-red-600 text-sm flex items-center gap-1" v-if="v$.diccionarioFelino.required.$invalid">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span id="error-message">El diccionario es requerido</span>
                </p>
                <p class="text-red-600 text-sm flex items-center gap-1" v-if="v$.diccionarioFelino.minLength.$invalid">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span id="error-message">Minimo una palabra requerida</span>
                </p>
                <p class="text-red-600 text-sm flex items-center gap-1" v-if="v$.diccionarioFelino.maxLength.$invalid">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span id="error-message">Máximo 1000 palabras permitidas</span>
                </p>
            </div>
            <div v-if="dictionaryErrors.length"  class="mt-1">
                <p class="text-red-600 text-sm flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span id="error-message"> {{ dictionaryErrors.join(',') }}</span>
                </p>
            </div>
            <button :disabled="v$.$invalid || dictionaryErrors.length > 0" @click="descifrarMaullido"
                class="mt-3 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow transition-all transform hover:scale-105 disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none disabled:hover:scale-100 disabled:hover:bg-green-600">
                 <svg class="animate-spin h-5 w-5 text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" v-if="isLoading">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span v-else>🐾 Descifrar Maullido</span>
            </button>
        </div>
        <!-- Visualización del maullido -->
         <div class="mb-6 bg-white p-4 rounded-lg shadow border border-green-100">
            <h3 class="text-lg font-medium text-green-800 mb-3">Maullido original:</h3>
            <div class="p-3 bg-gray-50 rounded font-mono text-lg" id="maullidoOriginal">
                {{ originalMaullido }}
            </div>
        </div>
        <!-- Resultados -->
        <div>
            <h2 class="text-2xl font-semibold text-purple-800 mb-4 flex items-center gap-2">
                <span class="text-3xl">🔍</span> Frases felinas encontradas
            </h2>
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-green-100">
                <div class="text-center p-8 bg-gradient-to-r from-green-50 to-purple-50" id="maullidoInitialState" v-if="maullidoSecreto.length === 0">
                    <div class="text-5xl mb-4">🐈‍</div>
                    <p class="text-gray-600">Introduce el maullido y el diccionario, luego haz click en <span class="font-bold text-green-600">"Descifrar Maullido"</span> para ver las posibles frases.</p>
                </div>

                <div class="" id="maullidoResultState" v-else>
                    <div class="p-4 border-b border-green-100 flex justify-between items-center bg-green-50">
                        <span class="text-sm font-medium text-green-800">Se encontraron <span id="frasesCount" class="font-bold">{{maullidoSecreto.length }}</span> posibles frases</span>          
                    </div>
                    <div class="divide-y divide-green-100 max-h-96 overflow-y-auto" id="frasesContainer">
                        <!-- frases encontradas --> 
                        <div class="p-4 hover:bg-green-50 transition-colors font-mono" v-for="(frase, idx) in maullidoSecreto" :key="idx">{{ frase }}</div>
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
    import api from '@/services/api';
import useVuelidate from '@vuelidate/core';
    import { helpers, maxLength, minLength, required } from '@vuelidate/validators';
    import {ref, computed} from 'vue';
    
    //validación de mayusculas
    const alphaLower = helpers.regex(/^[a-zñ]+$/);
    //obtencion de datos
    const maullido          = ref('');
    const diccionarioRaw    = ref('');
    const diccionarioFelino = ref([]);
    const dictionaryErrors  = ref([]);
    const maullidoSecreto   = ref([]);
    const originalMaullido  = ref('');
    const isLoading         = ref(false);
    //actualizar el diccionario
    const processDictionary = () => {
        dictionaryErrors.value = []
        //divide cada palabras por comas
        const palabras = diccionarioRaw.value.split(',').map(p => p.trim()).filter(p => p.length > 0);
        //valida cada palabra 
        const palabrasValidas = [];
        palabras.forEach((palabra, index) => {
            //valida longitud
            if(palabra.length < 1 || palabra.length > 10){
                dictionaryErrors.value.push(`"${palabra}" debe tener entre 1-10 caracteres`);
                return
            }
            //valida caracteres
            if(palabrasValidas.includes(palabra)){
                dictionaryErrors.value.push(`"${palabra}" está duplicada`);
                return
            }
            palabrasValidas.push(palabra);
        });
        //limita diccionario a 1000 palabras
        if(palabrasValidas.length > 1000){
            dictionaryErrors.value.push(`Máximo 1000 palabras permitidas (${palabrasValidas.length} ingresadas)`);
            diccionarioFelino.value = palabrasValidas.slice(0, 1000);
        }else{
            diccionarioFelino.value = palabrasValidas;
        }

        //valida cada vez que cambia el diccionario
        v$.value.$validate();
    }
    //reglas de validación
    const rules = {
        maullido:{
            required,
            minLength: minLength(1),
            maxLength: maxLength(20),
            alphaLower
        },
        diccionarioFelino:{
            required,
            minLength: minLength(1),
            maxLength: maxLength(1000),
            $each: helpers.forEach({
                required,
                minLength: minLength(1),
                maxLength: maxLength(10),
                alphaLower,
                isUnique: {
                    $validator: (value, siblings) => 
                    siblings.filter((v) => v === value).length <= 1,
                    $message: 'Esta palabra ya existe en el diccionario'
                }
            })
        }
    }
    //inicializar libreria Vuelidata
    const v$ = useVuelidate(rules, {maullido, diccionarioFelino});
    //peticion
    const descifrarMaullido = async () => {
         try{
            isLoading.value = true;
            const response = await api.post('/desifrar-maullido',{
                maullido            : maullido.value,
                diccionarioFelino   : diccionarioFelino.value
            });
            maullidoSecreto.value   = response.data.maullidoSecreto;
            originalMaullido.value  = response.data.maullido;
        }catch(error){
            console.error('Error: ', error);
            alert ('Intentalo nuevamente');
        }finally{
            isLoading.value = false;
        }
    }
</script>