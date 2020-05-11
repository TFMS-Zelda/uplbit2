<template>
  <div>
    <table class="table table-sm table-striped table-light table-hover table-fixed">
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
        <tr class="text-center" v-for="(monitor, index) in monitors" :key="index">
          <td>
            <div class="col-auto text-center">
              <i class="fas fa-tablet"></i>
              <br />
              <div class="h5 mb-0 font-weight-bold text-muted">{{ monitor.id }}</div>
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
              <div
                class="h6 mb-0 font-weight-bold text-muted"
              >{{ monitor.assignable.brand }} ~ {{ monitor.assignable.model }} ~ Serial: {{ monitor.assignable.serial }}</div>
              <small>
                {{ monitor.assignable.backlight }} ~
                {{ monitor.assignable.input_connector_type }}
                <br />
                {{ monitor.assignable.maximum_resolution }}
              </small>
              <br />
              <span class="badge badge-success">{{ monitor.assignable.license_plate }}</span>
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
              </div>
            </div>
          </td>
          <td>
            <button class="btn btn-success btn-circle btn-sm">
              <i class="fas fa-info-circle"></i>
            </button>
            <a class="btn btn-danger btn-circle btn-sm" v-on:click.prevent="deleteMonitor(monitor)">
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
      monitors: []
    };
  },
  methods: {
    async getMonitors() {
      const url = "/api/assignments/monitors";

      try {
        axios.get(url).then(response => {
          this.monitors = response.data;
        });
      } catch (error) {
        console.log(error);
      }
    },

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
          confirmButtonText: "Eliminar"
        }).then(result => {
          if (result.value) {
            Swal.fire(
              "Deleted!",
              `Se elimino la asignación del Monitor
              correctamente del sistema.`,
              "success"
            );
            axios.delete(urlDelete).then(response => {
              this.getMonitors();
            });
          }
        });
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>

<style lang="sass" scoped>

</style>