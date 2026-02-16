import { createRouter, createWebHistory } from 'vue-router';
import CoursesView from '../views/CoursesView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'courses',
      component: CoursesView
    },
    {
      path: '/students',
      name: 'students',
      // Carga perezosa para mejor rendimiento
      component: () => import('../views/StudentsView.vue')
    }
  ]
});

export default router;