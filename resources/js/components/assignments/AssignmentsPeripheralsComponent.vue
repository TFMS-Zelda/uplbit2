<template>
  <div>
    <table
      class="table table-sm table-striped table-light table-hover table-fixed"
      id="relationTable"
    >
      <thead class="thead-primary">
        <tr class="bg-gradient-primary text-white text-center">
          <th>
            <i class="fas fa-sort-numeric-down-alt"></i> ID:
          </th>
          <th>Assigned Employee:</th>
          <th>Tipo & Perisférico:</th>
          <th>Ubicación:</th>
          <th>Acciones:</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-center" v-for="(peripheral, index) in peripherals" :key="index">
          <td>
            <div class="col-auto text-center">
              <i class="fas fa-user"></i>
              <i class="fas fa-sort-numeric-down-alt"></i>
              <br />
              <div class="h5 mb-0 font-weight-bold text-muted">
                <span class="badge badge-success">{{ peripheral.employee.id }}</span>
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
              <div
                class="h6 mb-0 font-weight-bold text-muted"
              >{{ peripheral.assignable.type_device }} ~ {{ peripheral.assignable.type_other_peripherals }}</div>
              <small>
                {{ peripheral.assignable.brand }} ~
                {{ peripheral.assignable.model }}
                <br />
                <strong>Serial:</strong>
                : {{ peripheral.assignable.serial }}
              </small>
              <br />
              <span class="badge badge-success">{{ peripheral.assignable.license_plate }}</span>
            </div>
          </td>
          <td>
            <div class="col-auto text-assignable">
              <div class="h6 mb-0 font-weight-bold text-muted">
                <i class="fas fa-location-arrow"></i>
                {{ peripheral.employee.country }} ~ {{ peripheral.employee.city }}
                <br />
                <small>
                  {{ peripheral.employee.work_area }}
                  <br />Fecha de Asignación:
                  <br />
                  {{ peripheral.assignment_date }}
                </small>
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
import datatables from "datatables";

export default {
  created() {
    this.getPeripherals();
  },
  data() {
    return {
      peripherals: [],
    };
  },
  methods: {
    async getPeripherals() {
      const url = "/api/assignments/other-peripherals";

      try {
        axios.get(url).then((response) => {
          this.peripherals = response.data;
        });
      } catch (error) {
        console.log(error);
      }
    },

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
              `Se elimino la asignación del Perisférico
              correctamente del sistema.`,
              "success"
            );
            axios.delete(urlDelete).then((response) => {
              this.getPeripherals();
            });
          }
        });
      } catch (error) {
        console.log(error);
      }
    },
    myTable() {
      $(document).ready(function () {
        $("#relationTable").DataTable({
          order: [[0, "desc"]],
        });
      });
    },
  },
};
</script>

<style lang="sass" scoped>

</style>