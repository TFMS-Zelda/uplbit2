<template>
  <div>
    <table
      class="table table-sm table-striped table-light table-hover table-fixed"
      id="table-employees"
    >
      <thead class="thead-primary">
        <tr class="bg-gradient-primary text-white text-center">
          <th>
            <i class="fas fa-sort-numeric-down-alt"></i> ID:
          </th>
          <th>Assigned Employee:</th>
          <th>Equipo de computo:</th>
          <th>Ubicación:</th>
          <th>Acciones:</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-center" v-for="(computer, index) in computers" :key="index">
          <td>
            <div class="col-auto text-center">
              <i class="fas fa-laptop"></i>
              <br />
              <div class="h5 mb-0 font-weight-bold text-muted">{{ computer.id }}</div>
            </div>
          </td>
          <td>
            <div class="mb-0 font-weight-bold text-gray-600">
              <img
                class="img-fluid rounded-circle"
                :src="`/storage/Employees-avatar/${computer.employee.profile_avatar}`"
                alt="avatarEmployeeImage"
                width="40px"
              />
              <div class="mb-0 font-weight-bold text-gray-700">
                {{ computer.employee.name }}
                <br />
                {{ computer.employee.email_corporate }}
              </div>
            </div>
          </td>
          <td>
            <div class="col-auto text-assignable">
              <div
                class="h6 mb-0 font-weight-bold text-muted"
              >{{ computer.assignable.type_machine }} ~ {{ computer.assignable.model }} ~ {{ computer.assignable.brand }}</div>
              <small>
                {{ computer.assignable.processor }} ~
                {{ computer.assignable.memory_ram }} ~ {{ computer.assignable.hard_drive }}
                <br />
                {{ computer.assignable.operating_system }}
              </small>
              <br />
              <span class="badge badge-success">{{ computer.assignable.license_plate }}</span>
            </div>
          </td>
          <td>
            <div class="col-auto text-assignable">
              <div class="h6 mb-0 font-weight-bold text-muted">
                <i class="fas fa-location-arrow"></i>
                {{ computer.employee.country }} ~ {{ computer.employee.city }}
                <br />
                <small>
                  {{ computer.employee.work_area }}
                  <br />Fecha de Asignación:
                  <br />
                  {{ computer.assignment_date }}
                </small>
              </div>
            </div>
          </td>
          <td>
            <button class="btn btn-warning btn-circle btn-sm">
              <i class="fas fa-exclamation-triangle"></i>
            </button>
            <button class="btn btn-success btn-circle btn-sm">
              <i class="fas fa-info-circle"></i>
            </button>
            <a
              class="btn btn-danger btn-circle btn-sm"
              v-on:click.prevent="deleteComputer(computer)"
            >
              <i class="fas fa-times text-white"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  created() {
    this.getComputers();
  },
  data() {
    return {
      // #Modelo Relaciones y asignaciones
      computers: []
    };
  },

  methods: {
    // views: relationship-&-configurations/assignments/computers
    getComputers() {
      const url = "/api/assignments/computers";
      try {
        axios.get(url).then(response => {
          this.computers = response.data;
        });
      } catch (error) {}
    },

    deleteComputer(computer) {
      const urlDelete =
        "/relationship-&-configurations/assignments/computers/" + computer.id;
      try {
        Swal.fire({
          title: "¿Esta seguro?",
          text: "Eliminara la siguiente asignación!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then(result => {
          if (result.value) {
            Swal.fire(
              "Deleted!",
              `Se elimino la asignación del equipo de computo
              correctamente del sistema.`,
              "success"
            );
            axios.delete(urlDelete).then(response => {
              this.getComputers();
            });
          }
        });
      } catch (error) {}
    }
  }
};
</script>

<style lang="sass" scoped>

</style>