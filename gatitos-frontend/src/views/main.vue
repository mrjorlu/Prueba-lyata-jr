<template>
    <!-- Título de bienvenida -->
    <h1 class="text-4xl md:text-5xl font-bold text-center mb-8 text-purple-900">
      ¡Bienvenido a <span class="text-pink-500">Misiones Gatunas</span>! 🐱
    </h1>

    <!-- Subtítulo -->
    <p class="text-lg text-gray-700 mb-12 text-center max-w-md">
      ¿Listo para emprender aventuras llenas de ronroneos y travesuras? ¡Elige una misión!
    </p>

    <!-- Contenedor de botones -->
    <div class="flex flex-col sm:flex-row gap-4">
        <!-- problema 01 -->
        <router-link to="/ip-validas" class="button bg-amber-400 hover:bg-amber-500 text-amber-900 font-bold py-3 px-6 rounded-full shadow-lg transition-all transform hover:scale-105 flex items-center gap-2"><span class="text-xl">🏠</span> Casitas Númericas</router-link>
        <!-- problema 02 -->
        <router-link to="/siesta-felina" class="button bg-blue-400 hover:bg-blue-500 text-blue-900 font-bold py-3 px-6 rounded-full shadow-lg transition-all transform hover:scale-105 flex items-center gap-2"><span class="text-xl">💤</span> Siesta Felina</router-link>
        <!-- problema 03 -->
        <router-link to="/maullido-secreto" class="button bg-green-400 hover:bg-green-500 text-green-900 font-bold py-3 px-6 rounded-full shadow-lg transition-all transform hover:scale-105 flex items-center gap-2"><span class="text-xl">🕵️‍♂️ </span> Maullido Secreto</router-link>
    </div>
</template>

<script setup>
</script>