<template>
  <div class="card" style="width: 18rem;">
    <div class="card-header">
      <div class="row col-12">
        <div class="col-6">

      <h1 name="title">{{ title }}</h1>
        </div>
        <div class="col-6">
          <button @click="create()" class="btn btn-success">Agregar</button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <p class="card-text">{{ content }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',
  props: {
    title: {
      type: String,
      default: 'Card Title'
    },
    content: {
      type: String,
      default: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
    },

  },
  methods: {
    handleClick() {
      alert('Card clicked!');
    },
    create() {
      window.location.href = '/examenes/create';
    }
  }
}
</script>

<style scoped>
.card {
  width: 100% !important; 
  margin: 20px auto;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  transition: transform 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
}
</style>