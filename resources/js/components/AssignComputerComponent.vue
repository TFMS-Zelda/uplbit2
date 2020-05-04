<template>
  <div>
    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-laptop text-white"></i>
    </button>
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                  <i class="fa fa-times text-danger" aria-hidden="true"></i>
                </span>
              </button>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <div class="btn-group dropright">
                <button type="button" class="btn btn-ligth">
                  <h1 class="h6 mb-1 text-gray-800">Computers</h1>
                  <small class="text-muted">
                    <p class="text-right">Record & History</p>
                  </small>
                </button>
                <button
                  type="button"
                  class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <span class="sr-only">Toggle Dropright</span>
                </button>
                <div class="dropdown-menu">
                  <a v-on:click.prevent="getComputers" class="dropdown-item btn btn-ligth">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Equipos de computo en stock del inventario
                  </a>
                </div>
              </div>

              <p class="h4 mb-1 text-gray-800">Computer & Assign</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label>*Equipo de computo:</label>
                      <select
                        class="form-control"
                        v-model="selectComputer"
                        name="selectComputer"
                        required
                        autofocus
                      >
                        <option value>Escoger...</option>
                        <option
                          v-bind:value="computer.id"
                          v-for="(computer, index) in computers"
                          :key="index"
                        >
                          {{ computer.brand }} ~ {{ computer.model }} ~ {{ computer.servicetag }},
                          Placa Corporativa: {{ computer.license_plate }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" v-model="user_id" name="user_id" />
              <input type="hidden" v-model="employee_id" name="employee_id" />
              <div class="row">
                <div class="col-md-12">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>*Fecha de Asignación:</label>
                      <input
                        type="date"
                        class="form-control"
                        v-model="assignment_date"
                        name="assignment_date"
                        required
                        autofocus
                      />
                    </div>
                  </div>
                </div>
              </div>
              <p class="h4 mb-1 text-gray-800">Comentarios</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <textarea name="body" v-model="body" class="form-control" required autofocus></textarea>
                      <small class="form-text text-gray-600">Ingrese algun comentario u observación</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            <button type="button" class="btn btn-success" v-on:click="createAssignComputer">Asignar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id_user: {
      type: Number,
      required: true
    },
    id_employee: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      computers: [],
      selectComputer: "",
      assignment_date: "",
      user_id: this.id_user,
      employee_id: this.id_employee,
      body: ""
    };
  },
  methods: {
    getComputers() {
      const url = "/api/computers";
      axios.get(url).then(response => {
        this.computers = response.data;
      });
      try {
      } catch (error) {
        console.log(error);
      }
    },

    createAssignComputer() {
      const urlStore =
        "/relationship-&-configurations/assignments/computers/store";
      axios
        .post(urlStore, {
          selectComputer: this.selectComputer,
          assignment_date: this.assignment_date,
          user_id: this.user_id,
          employee_id: this.employee_id,
          body: this.body
        })
        .then(response => {
          this.getComputers();
          $("#exampleModal").modal("hide");
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Asignación de equipo de computo realizada correctamente!",
            showConfirmButton: false,
            timer: 1500
          });
        });
    }
  }
};
</script>
