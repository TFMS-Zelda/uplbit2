<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary btn-circle btn-lg"
      data-toggle="modal"
      data-target="#modalTablet"
    >
      <i class="fas fa-tablet"></i>
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="modalTablet"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2>
              <i class="fas fa-tablet"></i>
            </h2>
            <h5 class="modal-title" id="exampleModalLabel">&nbsp;Asignar Tablet Corporativa</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- split remove computers   -->
            <div class="btn-group dropright" v-if="!stateButton">
              <button type="button" class="btn btn-ligth">
                <h1 class="h6 mb-1 text-gray-800">Tablets</h1>
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
                <button @click="getTablets" class="dropdown-item">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Tablets corporativas en stock
                </button>
              </div>
            </div>
            <!-- end split tablets -->
            <form @submit.prevent="createAssignTablet" method="post">
              <!-- select tablet -->
              <p class="h4 mb-1 text-gray-800">Tablet Corporativa:</p>
              <div class="row" v-show="!validateArrayTablets">
                <div class="col-md-12">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <select
                        class="form-control"
                        name="selectTable"
                        v-model="form.selectTablet"
                        required
                      >
                        <option value>Seleccione...</option>
                        <option
                          v-bind:value="tablet.id"
                          v-for="(tablet, index) in tablets"
                          :key="index"
                        >
                          {{ tablet.brand }} ~ {{ tablet.model }} ~ Serial: {{ tablet.serial }}
                          ~ Placa: {{ tablet.license_plate }}
                        </option>
                      </select>
                      <has-error :form="form" field="selectTablet"></has-error>
                    </div>
                  </div>
                </div>
              </div>

              <div class="alert alert-danger" v-show="stateButton && validateArrayTablets">
                <strong>
                  <h4>
                    <i class="fas fa-exclamation-circle"></i> Sin Stock!
                  </h4>
                  <p>
                    No cuenta en este momento con Tablets suficientes para ser asignadas.
                    Agrege una nueva tablet al inventario.
                  </p>
                </strong>
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
              <input type="hidden" v-model="form.user_id" v-show="false" name="user_id" />
              <input type="hidden" v-model="form.employee_id" v-show="false" name="employee_id" />
              <button
                type="submit"
                class="btn btn-outline-primary"
                :disabled="!stateButton || validateArrayTablets === true"
              >Guardar</button>
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
      required: true
    },
    id_employee: {
      type: Number,
      required: false
    }
  },
  data() {
    return {
      form: new Form({
        selectTablet: "",
        assignment_date: "",
        employee_id: this.id_employee,
        user_id: this.id_user
      }),

      tablets: [],
      stateButton: false
    };
  },
  methods: {
    async getTablets() {
      try {
        const url = "/api/tablets";
        const response = await axios.get(url);
        this.tablets = response.data;
        this.stateButton = true;
      } catch (error) {
        console.log(error);
      } finally {
        // console.log("200");
      }
    },

    createAssignTablet(event) {
      const urlStore =
        "/relationship-&-configurations/assignments/tablets/store";

      this.form
        .post(urlStore, {
          selectTablet: this.selectTablet,
          assignment_date: this.assignment_date,
          user_id: this.user_id,
          employee_id: this.employee_id,
          body: this.body
        })
        .then(response => {
          this.getTablets();
          $("#modalTablet").modal("hide");
          this.form.selectTablet = this.form.assignment_date = this.form.body =
            "";
          event.target.reset();

          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Asignación de Tablet Corporativa realizada correctamente!",
            showConfirmButton: false,
            timer: 1500
          });
        });
    }
  },

  computed: {
    validateArrayTablets() {
      if (this.tablets.length === 0) {
        return true;
      } else {
        return false;
      }
    }
  }
};
</script>

<style lang="sass" scoped>

</style>