<template>
  <div>
    <table
      class="table table-sm table-striped table-light table-hover table-fixed"
      id="table-monitors"
    >
      <thead class="thead-primary">
        <tr class="bg-gradient-primary text-white text-center">
          <th>ID</th>
          <th>Assigned Employee:</th>
          <th>Display Peripheral:</th>
          <th>Ubicación:</th>
          <th>Acciones:</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="monitor in monitors" :key="monitor.id" class="text-center">
          <td>
            <div class="col-auto text-center">
              <i class="fas fa-user"></i>
              <i class="fas fa-sort-numeric-down-alt"></i>
              <br />
              <div class="h5 mb-0 font-weight-bold text-muted">
                <span class="badge badge-primary">{{
                  monitor.employee.id
                }}</span>
              </div>
            </div>
          </td>
          <td>
            <div class="mb-0 font-weight-bold text-gray-600">
              <img
                class="img-fluid rounded-circle"
                :src="`/storage/Employees-avatar/${monitor.employee.profile_avatar}`"
                alt="avatarEmployeeImage"
                width="40px"
              />
              <div class="mb-0 font-weight-bold text-gray-700">
                {{ monitor.employee.name }}
                <br />
                {{ monitor.employee.email_corporate }}
              </div>
            </div>
          </td>
          <td>
            <div class="col-auto text-assignable">
              <div class="h6 mb-0 font-weight-bold text-muted">
                <i class="fas fa-laptop"></i>

                <span class="badge badge-info"
                  >Cí N° {{ monitor.assignable.id }}</span
                >
                ,
                {{ monitor.assignable.type_machine }} ~
                {{ monitor.assignable.model }} ~
                {{ monitor.assignable.brand }}
              </div>
              <img
                class="img-thumbnail"
                src="/core/undraw/monitor.svg"
                width="55px"
                alt="monitor-assignment"
              />
              <small>
                {{ monitor.assignable.processor }} ~
                {{ monitor.assignable.memory_ram }} ~
                {{ monitor.assignable.hard_drive }}
                <br />
                {{ monitor.assignable.operating_system }}
              </small>
              <br />
              <span class="badge badge-success">{{
                monitor.assignable.license_plate
              }}</span>
            </div>
          </td>
          <td>
            <div class="col-auto text-assignable">
              <div class="h6 mb-0 font-weight-bold text-muted">
                <i class="fas fa-location-arrow"></i>
                {{ monitor.employee.country }} ~ {{ monitor.employee.city }}
                <br />
                <small>
                  {{ monitor.employee.work_area }}
                  <br />Fecha de Asignación:
                  <br />
                  {{ monitor.assignment_date }}
                </small>
                <br />

                <small>{{ monitor.assignable.hostname }}</small>
              </div>
            </div>
          </td>
          <td>
            <button class="btn btn-success btn-circle btn-sm">
              <i class="fas fa-info-circle"></i>
            </button>
            <a
              class="btn btn-danger btn-circle btn-sm"
              v-on:click.prevent="deleteMonitor(monitor)"
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
    this.getMonitors();
  },
  data() {
    return {
      // #Modelo Relaciones y asignaciones
      monitors: {},
      search: "",
    };
  },

  methods: {
    deleteMonitor(monitor) {
      const urlDelete =
        "/relationship-&-configurations/assignments/monitors/" + monitor.id;
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
              `Se elimino la asignación del equipo de un Monitor
              correctamente del sistema.`,
              "success"
            );
            axios.delete(urlDelete).then((response) => {
              this.getMonitors();
            });
          }
        });
      } catch (error) {}
    },

    async getMonitors() {
      try {
        const url = "/api/assignments/monitors";
        const response = await axios.get(url);
        this.monitors = response.data;
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
        $("#table-monitors").DataTable({
          order: [[0, "desc"]],
        });
      });
    },
  },

  computed: {},
};
</script>
