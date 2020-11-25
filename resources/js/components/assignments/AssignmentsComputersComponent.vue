<template>
  <div>
    <table
      class="table table-sm table-striped table-light table-hover table-fixed"
      id="table-employees"
    >
      <thead class="thead-primary">
        <tr class="bg-gradient-primary text-white text-center">
          <th>ID</th>
          <th>Assigned Employee:</th>
          <th>Equipo de Computo:</th>
          <th>Ubicación:</th>
          <th>Acciones:</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="computer in computers"
          :key="computer.id"
          class="text-center"
        >
          <td>
            <div class="col-auto text-center">
              <i class="fas fa-user"></i>
              <i class="fas fa-sort-numeric-down-alt"></i>
              <br />
              <div class="h5 mb-0 font-weight-bold text-muted">
                <span class="badge badge-success">{{
                  computer.employee.id
                }}</span>
              </div>
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
              <div class="h6 mb-0 font-weight-bold text-muted">
                <i class="fas fa-laptop"></i>

                <span class="badge badge-info"
                  >Cí N° {{ computer.assignable.id }}</span
                >
                ,
                {{ computer.assignable.type_machine }} ~
                {{ computer.assignable.model }} ~
                {{ computer.assignable.brand }}
              </div>
              <small>
                {{ computer.assignable.processor }} ~
                {{ computer.assignable.memory_ram }} ~
                {{ computer.assignable.hard_drive }}
                <br />
                {{ computer.assignable.operating_system }}
              </small>
              <br />
              <span class="badge badge-success">{{
                computer.assignable.license_plate
              }}</span>
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
                <br />
                <small>{{ computer.assignable.hostname }}</small>
              </div>
            </div>
          </td>
          <td>
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
      computers: {},
      search: "",
    };
  },

  methods: {
    deleteComputer(computer) {
      const urlDelete =
        "/relationship-&-configurations/assignments/computers/" + computer.id;
      try {
        Swal.fire({
          title: "¿Esta seguro?",
          text: "Eliminara la siguiente Asignación!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Eliminar",
        }).then((result) => {
          if (result.value) {
            Swal.fire(
              "Deleted!",
              `Se elimino la asignación del equipo de computo
              correctamente del sistema.`,
              "success"
            );
            axios.delete(urlDelete).then((response) => {
              this.getComputers();
            });
          }
        });
      } catch (error) {}
    },

    async getComputers() {
      try {
        const url = "/api/assignments/computers";
        const response = await axios.get(url);
        this.computers = response.data;
        this.myTable();
      } catch (error) {
        console.log(error);
      }
    },

    // getComputers(page = 1) {
    //   axios.get("/api/assignments/computers?page=" + page).then(response => {
    //     this.computers = response.data;
    //     this.myTable();
    //   });
    // },

    myTable() {
      $(document).ready(function () {
        $("#table-employees").DataTable({
          order: [[0, "desc"]],
        });
      });
    },
  },

  computed: {},
};
</script>

<style lang="sass" scoped>
</style>
