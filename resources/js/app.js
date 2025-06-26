import '../sass/app.scss';
import './bootstrap';
import { createApp } from 'vue';

import Card from './components/Card.vue';
import Examenes from './components/examenes/List.vue';
import Preguntas from './components/preguntas/List.vue';
import ExamenesCreate from './components/examenes/Form.vue';
import PreguntasCreate from './components/preguntas/Form.vue';
import RespuestasCreate from './components/respuestas/Form.vue';
import Respuestas        from './components/respuestas/Form.vue';
import ExamenesShow from './components/examenes/show/List.vue';

const app = createApp({});

app.component('card', Card);
app.component('examenes',Examenes);
app.component('examenes-create',ExamenesCreate);
app.component('preguntas',Preguntas);
app.component('preguntas-create',PreguntasCreate);
app.component('respuestas-create',RespuestasCreate);
app.component('respuestas', Respuestas);
app.component('examenes-show',ExamenesShow);

app.mount('#app');