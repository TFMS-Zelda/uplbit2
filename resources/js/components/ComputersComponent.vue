<template>
  <div></div>
</template>

<script>
const urlBase = "http://localhost:8000/api/computers";
export default {
  data() {
    return {
      computers: []
    };
  },

  methods: {
    getComputers() {
      try {
        axios.get(urlBase).then(response => {
          this.computers = response.data;
        });
      } catch (error) {
        console.log(error);
      } finally {
        console.log("Equipos de computo obtenidos!");
      }
    }
  }
};
</script>

<style lang="sass" scoped>

</style>