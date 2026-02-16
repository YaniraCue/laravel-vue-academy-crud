<template>
  <div class="container">
    <h2>Gestión de Cursos</h2>

    <div class="card form-card">
      <h3>{{ isEditing ? 'Editar Curso' : 'Crear Nuevo Curso' }}</h3>
      <form @submit.prevent="handleSubmit">
        <input v-model="courseForm.name" placeholder="Nombre del curso" required />
        <textarea v-model="courseForm.description" placeholder="Descripción del curso" required></textarea>
        
        <button type="submit">{{ isEditing ? 'Actualizar Curso' : 'Guardar Curso' }}</button>
        <button v-if="isEditing" type="button" @click="cancelEdit" class="delete-btn" style="color: gray">Cancelar</button>
      </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="course in courses" :key="course.id">
          <td>{{ course.name }}</td>
          <td>{{ course.description }}</td>
          <td>
            <button @click="prepareEdit(course)" class="delete-btn" style="color: var(--primary); margin-right: 10px;">Editar</button>
            <button @click="deleteCourse(course.id)" class="delete-btn">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../api/axios';

const courses = ref([]);
const isEditing = ref(false);
const editingId = ref(null);
const courseForm = ref({ name: '', description: '' });

const fetchCourses = async () => {
  const response = await api.get('/courses');
  courses.value = response.data;
};

const prepareEdit = (course) => {
  isEditing.value = true;
  editingId.value = course.id;
  courseForm.value = { ...course };
};

const cancelEdit = () => {
  isEditing.value = false;
  editingId.value = null;
  courseForm.value = { name: '', description: '' };
};

const handleSubmit = async () => {
  try {
    if (isEditing.value) {
      await api.put(`/courses/${editingId.value}`, courseForm.value);
    } else {
      await api.post('/courses', courseForm.value);
    }
    cancelEdit();
    fetchCourses();
  } catch (error) {
    alert("Error: " + (error.response?.data?.message || "No se pudo procesar"));
  }
};

const deleteCourse = async (id) => {
  if (confirm('¿Eliminarás este curso? Esto podría afectar a los estudiantes matriculados.')) {
    await api.delete(`/courses/${id}`);
    fetchCourses();
  }
};

onMounted(fetchCourses);
</script>