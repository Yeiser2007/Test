<template>
  <div>
    <div class="row col-12">
      <div class="col-6">
        <h2>Preguntas del examen</h2>
      </div>
    </div>
    <table class="examenes-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Pregunta</th>
          <th>Creado</th>
          <th>Actualizado</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="loading">
          <td colspan="5" class="text-center">Cargando...</td>
        </tr>
        <tr v-else-if="examenes.length === 0">
          <td colspan="5" class="text-center">No hay exámenes registrados</td>
        </tr>
        <tr v-for="examen in examenes" :key="examen.id">
          <td>{{ examen.id }}</td>
          <td>{{ examen.preguntas.description }}</td>
          <td>{{ formatFecha(examen.created_at) }}</td>
          <td>{{ formatFecha(examen.updated_at) }}</td>
          <td>
            <button @click="eliminarExamen(examen.id)" class="btn-delete">Eliminar</button>
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
  examen_id: Number,
})

const examenes = ref([]);
const loading = ref(true);
const pagination = ref({
  current_page: 1,
  last_page: 1,
  per_page: 10,
  total: 0
});

const fetchExamenes = async (page = 1) => {
  try {
    loading.value = true;
    const response = await axios.get(`/examenes/data/${props.examen_id}`);

    examenes.value = response.data.data;
    pagination.value = {
      current_page: response.data.current_page,
      last_page: response.data.last_page,
      per_page: response.data.per_page,
      total: response.data.total
    };

  } catch (error) {
    console.error('Error al obtener exámenes:', error);
  } finally {
    loading.value = false;
  }
};
const formatFecha = (fecha) => {
  return new Date(fecha).toLocaleDateString();
};

const cambiarPagina = (page) => {
  if (page >= 1 && page <= pagination.value.last_page) {
    fetchExamenes(page);
  }
};

const eliminarExamen = async (id) => {
  if (confirm('¿Estás seguro de eliminar este examen?')) {
    try {
      await axios.delete(`/examenespreguntas/${id}`);
      alert('Examen eliminado correctamente');
      fetchExamenes(pagination.value.current_page);
    } catch (error) {
      console.error('Error al eliminar examen:', error);
      alert('No se pudo eliminar el examen');
    }
  }
};

onMounted(() => {
  fetchExamenes();
});
</script>

<style scoped>
.examenes-table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
}

.examenes-table th,
.examenes-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.examenes-table th {
  background-color: #f2f2f2;
}

.examenes-table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.examenes-table tr:hover {
  background-color: #f1f1f1;
}

.btn-edit,
.btn-delete {
  padding: 5px 10px;
  margin: 0 5px;
  cursor: pointer;
}

.btn-edit {
  background-color: #4CAF50;
  color: white;
  border: none;
}

.btn-delete {
  background-color: #f44336;
  color: white;
  border: none;
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
