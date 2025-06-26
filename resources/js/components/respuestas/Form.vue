<template>
    <form @submit.prevent="submitForm"> 
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" class="form-control" id="descripcion" v-model="formData.description" required>
        </div>
        <!-- checkbox para validar si es 1 o 0 -->
        <div class="form-group">
            <label for="correcta">¿Es correcta?</label>
            <input type="checkbox" class="form-check-input" id="correcta" value="0" v-model="formData.correcta">
        </div>
        <div class="form-group">
            <label for="activo">¿Está activa?</label>
            <input type="checkbox" class="form-check-input" id="activo" value="0" v-model="formData.activo">
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

const props = defineProps({
  pregunta_id: Number,
})

const formData = ref({
    id: '',
    id_pregunta: props.pregunta_id,
    description: '',
    correcta: '0',
    activo: ''
});
const loading = ref(false);
const message = ref('');
const messageType = ref('');

const submitForm = async () => {
    loading.value = true;
    message.value = '';

    try {
        const response = await axios.post('/respuestas', formData.value, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        message.value = response.data.message || 'Pregunta creado exitosamente';
        messageType.value = 'success';
        formData.value = {
            description: '',
            id_pregunta: props.pregunta_id,
            correcta: '',
            activo: ''
        };
        window.location.href = `/preguntas/${props.pregunta_id}`;

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
