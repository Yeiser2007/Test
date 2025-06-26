<template>
    <form @submit.prevent="submitForm">
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" v-model="formData.description" required>
        </div>
        <button type="submit" :disabled="loading">
            {{ loading ? 'Enviando...' : 'Generar pregunta' }}
        </button>

        <div v-if="message" :class="['message', messageType]">
            {{ message }}
        </div>
    </form>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const formData = ref({
    description: '',
});
const users = ref([]);
const loading = ref(false);
const message = ref('');
const messageType = ref('');

const submitForm = async () => {
    loading.value = true;
    message.value = '';

    try {
        const response = await axios.post('/preguntas', formData.value, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        message.value = response.data.message || 'Pregunta creado exitosamente';
        messageType.value = 'success';
        window.location.href = '/preguntas';
        formData.value = {
            description: '',
        };

    } catch (error) {
        if (error.response) {
            message.value = error.response.data.message || 'Error al crear la pregunta';
        } else if (error.request) {
            message.value = 'No se recibió respuesta del servidor';
        } else {
            message.value = 'Error al enviar el formulario';
        }
        messageType.value = 'error';
        console.error('Error:', error);
    } finally {
        loading.value = false;
    }
};
</script>
