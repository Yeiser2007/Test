<template>
  <div>
    <div class="col-12 d-flex justify-content-end">
      <button @click="create()" class="btn btn-success">Agregarr</button>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descripcion</th>
          <th>Correcta</th>
          <th>Estado</th>
          <th>Actualizado</th>
          <th>Creado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="loading">
          <td colspan="5" class="text-center">Cargando...</td>
        </tr>
        <tr v-else-if="respuestas.length === 0">
          <td colspan="5" class="text-center">No hay exámenes registrados</td>
        </tr>
        <tr v-for="pregunta in respuestas" :key="pregunta.id">
          <td>{{ pregunta.id }}</td>
          <td>{{ pregunta.description }}</td>
          <td>{{ pregunta.correcta }}</td>
          <td>{{ pregunta.activo }}</td>
          <td>{{ formatFecha(pregunta.created_at) }}</td>
          <td>{{ formatFecha(pregunta.updated_at) }}</td>
          <td>
            <div class="d-flex gap-3">
              <button @click="editarPregunta(pregunta.id)" class="btn btn-info">Editar</button>
              <button @click="eliminarPregunta(pregunta.id)" class="btn btn-danger">Eliminar</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-if="pagination.last_page > 1" class="pagination">
      <button @click="cambiarPagina(pagination.current_page - 1)" :disabled="pagination.current_page === 1">
        Anterior
      </button>

      <span>Página {{ pagination.current_page }} de {{ pagination.last_page }}</span>

      <button @click="cambiarPagina(pagination.current_page + 1)"
        :disabled="pagination.current_page === pagination.last_page">
        Siguiente
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
  pregunta_id: Number,
})

const respuestas = ref([]);
const loading = ref(true);
const pagination = ref({
  current_page: 1,
  last_page: 1,
  per_page: 10,
  total: 0
});
const create = () => {
  window.location.href = `/respuesta/pregunta/${props.pregunta_id}`;
}
const fetchRespuestasrespuestas = async (page = 1) => {
  try {
    loading.value = true;
    const response = await axios.get(`/respuestas?page=${page}`);
    respuestas.value = response.data.data;
    pagination.value = {
      current_page: response.data.current_page,
      last_page: response.data.last_page,
      per_page: response.data.per_page,
      total: response.data.total
    };

  } catch (error) {
    console.error('Error al obtener exámenes:', error);
    alert('No se pudieron cargar los exámenes');
  } finally {
    loading.value = false;
  }
};
const formatFecha = (fecha) => {
  return new Date(fecha).toLocaleDateString();
};

const cambiarPagina = (page) => {
  if (page >= 1 && page <= pagination.value.last_page) {
    fetchPreguntaes(page);
  }
};

const editarPregunta = (id) => {
  console.log('Editar pregunta:', id);
};
const agregarRespuestas = (id) => {
  window.location.href = `/respuestas/${id}`;
};

const eliminarPregunta = async (id) => {
  if (confirm('¿Estás seguro de eliminar este pregunta?')) {
    try {
      await axios.delete(`/respuestas/${id}`);
      alert('Pregunta eliminado correctamente');
      window.location.reload();
    } catch (error) {
      console.error('Error al eliminar pregunta:', error);
      alert('No se pudo eliminar el pregunta');
    }
  }
};

onMounted(() => {

  fetchRespuestasrespuestas();
});
</script>

<style scoped>
.table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
}

.table th,
.table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.table th {
  background-color: #f2f2f2;
}

.table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.table tr:hover {
  background-color: #f1f1f1;
}


.pagination {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.pagination button {
  padding: 5px 10px;
  cursor: pointer;
}

.pagination button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.text-center {
  text-align: center;
}
</style>
