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
          <th>Tablet Corporativa:</th>
          <th>Ubicación:</th>
          <th>Acciones:</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-center" v-for="(tablet, index) in tablets" :key="index">
          <td>
            <div class="col-auto text-center">
              <i class="fas fa-tablet"></i>
              <br />
              <div class="h5 mb-0 font-weight-bold text-muted">{{ tablet.id }}</div>
            </div>
          </td>
          <td>
            <div class="mb-0 font-weight-bold text-gray-600">
              <img
                class="img-fluid rounded-circle"
                :src="`/storage/Employees-avatar/${tablet.employee.profile_avatar}`"
                alt="avatarEmployeeImage"
                width="40px"
              />
              <div class="mb-0 font-weight-bold text-gray-700">
                {{ tablet.employee.name }}
                <br />
                {{ tablet.employee.email_corporate }}
              </div>
            </div>
          </td>
          <td>
            <div class="col-auto text-assignable">
              <div
                class="h6 mb-0 font-weight-bold text-muted"
              >{{ tablet.assignable.brand }} ~ {{ tablet.assignable.model }} ~ Serial: {{ tablet.assignable.serial }}</div>
              <small>
                {{ tablet.assignable.processor }} ~
                {{ tablet.assignable.memory }}
                <br />
                {{ tablet.assignable.operating_system }}
              </small>
              <br />
              <span class="badge badge-success">{{ tablet.assignable.license_plate }}</span>
            </div>
          </td>
          <td>
            <div class="col-auto text-assignable">
              <div class="h6 mb-0 font-weight-bold text-muted">
                <i class="fas fa-location-arrow"></i>
                {{ tablet.employee.country }} ~ {{ tablet.employee.city }}
                <br />
                <small>
                  {{ tablet.employee.work_area }}
                  <br />Fecha de Asignación:
                  <br />
                  {{ tablet.assignment_date }}
                </small>
              </div>
            </div>
          </td>
          <td>
            <button class="btn btn-success btn-circle btn-sm">
              <i class="fas fa-info-circle"></i>
            </button>
            <a class="btn btn-danger btn-circle btn-sm" v-on:click.prevent="deleteTablet(tablet)">
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
    this.getTablets();
  },
  data() {
    return {
      tablets: []
    };
  },

  methods: {
    async getTablets() {
      try {
        const url = "/api/assignments/tablets";
        const response = await axios.get(url);
        this.tablets = response.data;
        this.myTable();
      } catch (error) {
        console.log(error);
      }
    },

    deleteTablet(tablet) {
      const urlDelete =
        "/relationship-&-configurations/assignments/tablets/" + tablet.id;
      try {
        Swal.fire({
          title: "¿Esta seguro?",
          text: "Eliminara la siguiente Asignación!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Eliminar"
        }).then(result => {
          if (result.value) {
            Swal.fire(
              "Deleted!",
              `Se elimino la asignación de la Tablet corporativa
              correctamente del sistema.`,
              "success"
            );
            axios.delete(urlDelete).then(response => {
              this.getTablets();
            });
          }
        });
      } catch (error) {
        console.log(error);
      }
    },

    myTable() {
      $(document).ready(function() {
        $("#relationTable").DataTable();
      });
    }
  }
};
</script>

<style lang="sass" scoped>

</style>