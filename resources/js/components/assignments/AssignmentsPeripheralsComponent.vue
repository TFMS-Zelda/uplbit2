<template>
  <div>
    <table
      class="table table-sm table-striped table-light table-hover table-fixed"
      id="table-peripherals"
    >
      <thead class="thead-primary">
        <tr class="bg-gradient-primary text-white text-center">
          <th>ID</th>
          <th>Assigned Employee:</th>
          <th>Tipo & Perisférico:</th>
          <th>Ubicación:</th>
          <th>Acciones:</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="peripheral in peripherals"
          :key="peripheral.id"
          class="text-center"
        >
          <td>
            <div class="col-auto text-center">
              <i class="fas fa-user"></i>
              <i class="fas fa-sort-numeric-down-alt"></i>
              <br />
              <div class="h5 mb-0 font-weight-bold text-muted">
                <span class="badge badge-success">{{
                  peripheral.assignable.id
                }}</span>
              </div>
            </div>
          </td>
          <td>
            <div class="mb-0 font-weight-bold text-gray-600">
              <img
                class="img-fluid rounded-circle"
                :src="`/storage/Employees-avatar/${peripheral.employee.profile_avatar}`"
                alt="avatarEmployeeImage"
                width="40px"
              />
              <div class="mb-0 font-weight-bold text-gray-700">
                {{ peripheral.employee.name }}
                <br />
                {{ peripheral.employee.email_corporate }}
              </div>
            </div>
          </td>
          <td>
            <div class="col-auto text-assignable">
              <div class="h6 mb-0 font-weight-bold text-muted">
                <i class="fas fa-asterisk"></i>

                <span class="badge badge-info"
                  >Cí N° {{ peripheral.assignable.id }}</span
                >
                ,
                {{ peripheral.assignable.type_device }} ~
                {{ peripheral.assignable.type_other_peripherals }}
                <br />
                {{ peripheral.assignable.brand }}

                {{ peripheral.assignable.model }}
                {{ peripheral.assignable.serial }}
              </div>

              <span class="badge badge-success">{{
                peripheral.assignable.license_plate
              }}</span>
            </div>
          </td>
          <td>
            <div class="col-auto text-assignable">
              <div class="h6 mb-0 font-weight-bold text-muted">
                <i class="fas fa-location-arrow"></i>
                {{ peripheral.employee.country }} ~
                {{ peripheral.employee.city }}
                <br />
                <small>
                  {{ peripheral.employee.work_area }}
                  <br />Fecha de Asignación:
                  <br />
                  {{ peripheral.assignment_date }}
                </small>
                <br />
              </div>
            </div>
          </td>
          <td>
            <button class="btn btn-success btn-circle btn-sm">
              <i class="fas fa-info-circle"></i>
            </button>
            <a
              class="btn btn-danger btn-circle btn-sm"
              v-on:click.prevent="deletePeripheral(peripheral)"
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
    this.getPeripherals();
  },
  data() {
    return {
      // #Modelo Relaciones y asignaciones
      peripherals: {},
      search: "",
    };
  },

  methods: {
    deletePeripheral(peripheral) {
      const urlDelete =
        "/relationship-&-configurations/assignments/other-peripherals/" +
        peripheral.id;
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
              `Se elimino la asignación del siguiente períferico
              correctamente del sistema.`,
              "success"
            );
            axios.delete(urlDelete).then((response) => {
              this.getPeripherals();
            });
          }
        });
      } catch (error) {}
    },

    async getPeripherals() {
      try {
        const url = "/api/assignments/other-peripherals";

        const response = await axios.get(url);
        this.peripherals = response.data;
        this.myTable();
      } catch (error) {
        console.log(error);
      }
    },

    // getPeripherals(page = 1) {
    //   axios.get("/api/assignments/peripherals?page=" + page).then(response => {
    //     this.peripherals = response.data;
    //     this.myTable();
    //   });
    // },

    myTable() {
      $(document).ready(function () {
        $("#table-peripherals").DataTable({
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
