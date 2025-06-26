<template>
    <form @submit.prevent="submitForm">
        <div class="form-group">
            <label for="numero_preguntas">Selecciona el usuario</label>
            <select class="form-control" name="user_id" id="user_id" v-model="formData.id_usuario" required>
                <option value="">Selecciona un usuario</option>
                <option v-for="user in users.data" :key="user.id" :value="user.id">{{ user.nombre }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="numero_preguntas">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" v-model="formData.description">
        </div>
        <button type="submit" :disabled="loading">
            {{ loading ? 'Enviando...' : 'Crear Examen' }}
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
    id_usuario: '',
    description: '',
});

const loading = ref(false);
const users = ref([]);
const message = ref('');
const messageType = ref('');

const fetchUsers = async () => {
    try {
        const response = await axios.get(`/user/data`);
        users.value = response.data;
    } catch (error) {
        console.error('Error al obtener usuarios:', error);
        alert('No se pudieron cargar los usuario');
    }
};

const submitForm = async () => {
    loading.value = true;
    message.value = '';

    try {
        const response = await axios.post('/examenes/random', formData.value, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        message.value = response.data.message || 'Examen creado exitosamente';
        messageType.value = 'success';
        window.location.href = '/examenes';
        formData.value = {
            id_usuario: '',
            description: '',
        };

    } catch (error) {
        if (error.response) {
            message.value = error.response.data.message || 'Error al crear el examen';
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
onMounted(() => {
    fetchUsers();
});
</script>
