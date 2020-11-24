<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary btn-circle btn-lg"
      data-toggle="modal"
      data-target="#modalComputer"
    >
      <i class="fas fa-laptop"></i>
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="modalComputer"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2>
              <i class="fas fa-laptop"></i>
            </h2>
            <h5 class="modal-title" id="exampleModalLabel">&nbsp;Asignar Equipo de Computo</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- split remove computers   -->
            <div class="btn-group dropright" v-if="!stateButton">
              <button type="button" class="btn btn-ligth">
                <h1 class="h6 mb-1 text-gray-800">Computers</h1>
                <small class="text-muted">
                  <p class="text-right">Record & Stock</p>
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
                <button @click="getComputers" class="dropdown-item">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Equipos de computo en stock
                </button>
              </div>
            </div>
            <!-- end split  computers -->
            <form @submit.prevent="createAssignComputer" method="post">
              <!-- select computer -->
              <p class="h4 mb-1 text-gray-800">Equipos de Computo:</p>
              <div class="row" v-show="!validateArrayComputers">
                <div class="col-md-12">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <select
                        class="form-control"
                        name="selectTable"
                        v-model="form.selectComputer"
                        required
                      >
                        <option value>Seleccione...</option>
                        <option
                          v-bind:value="computer.id"
                          v-for="(computer, index) in computers"
                          :key="index"
                        >
                          {{ computer.brand }} ~ {{ computer.model }} ~ Serial: {{ computer.serial }}
                          ~ Placa: {{ computer.license_plate }}
                        </option>
                      </select>
                      <has-error :form="form" field="selectComputer"></has-error>
                    </div>
                  </div>
                </div>
              </div>

              <div class="alert alert-danger" v-show="stateButton && validateArrayComputers">
                <strong>
                  <h4>
                    <i class="fas fa-exclamation-circle"></i> Sin Stock!
                  </h4>
                </strong>

                <p>
                  No cuenta en este momento con
                  <strong>Equipos de Computo</strong> suficientes para ser asignados.
                  Agrege una nuevo Equipo de Computo al inventario.
                </p>
              </div>

              <!-- select date -->
              <p class="h4 mb-1 text-gray-800">Fecha de Asignación:</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input
                        type="date"
                        class="form-control"
                        v-model="form.assignment_date"
                        name="assignment_date"
                        required
                      />
                      <has-error :form="form" field="assignment_date"></has-error>
                    </div>
                  </div>
                </div>
              </div>

              <!-- select comentarios -->
              <p class="h4 mb-1 text-gray-800">Comentarios & Observaciones:</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <textarea
                        name="body"
                        class="form-control"
                        placeholder="Ingrese sus comentarios y observaciones"
                        cols="20"
                        rows="5"
                        v-model="form.body"
                        minlength="4"
                        maxlength="512"
                        required
                      ></textarea>
                      <has-error :form="form" field="body"></has-error>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" v-show="false" name="user_id" />
              <input type="hidden" v-show="false" name="employee_id" />
              <button
                type="submit"
                class="btn btn-outline-primary"
                :disabled="!stateButton || validateArrayComputers === true"
              >Asignar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            </form>
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
      required: true,
    },
    id_employee: {
      type: Number,
      required: false,
    },
  },
  data() {
    return {
      form: new Form({
        selectComputer: "",
        assignment_date: "",
        body: "",
        user_id: this.id_user,
        employee_id: this.id_employee,
      }),

      computers: [],

      stateButton: false,
    };
  },

  methods: {
    getComputers() {
      const url = "/api/computers";
      axios.get(url).then((response) => {
        this.computers = response.data;
        this.stateButton = true;
      });
      try {
      } catch (error) {
        console.log(error);
      }
    },

    createAssignComputer(event) {
      const urlStore =
        "/relationship-&-configurations/assignments/computers/store";

      this.form
        .post(urlStore, {
          selectComputer: this.selectComputer,
          assignment_date: this.assignment_date,
          user_id: this.user_id,
          employee_id: this.employee_id,
          body: this.body,
        })
        .then((response) => {
          this.getComputers();
          $("#modalComputer").modal("hide");
          this.form.selectComputer = this.form.assignment_date = this.form.body =
            "";
          event.target.reset();

          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Asignación de equipo de computo realizada correctamente!",
            showConfirmButton: false,
            timer: 1500,
          });
        });
    },
  },

  computed: {
    validateArrayComputers() {
      if (this.computers.length === 0) {
        return true;
      } else {
        return false;
      }
    },
  },
};
</script>
