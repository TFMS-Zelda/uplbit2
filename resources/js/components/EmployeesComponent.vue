<template>
  <div>
    <div class="card mb-4 py-3 border-left-primary">
      <div class="card-body">
        <input type="search" v-model="search" placeholder="Buscar empleado..." class="form-control" />
        <div class="table-responsive">
          <table
            class="table table-sm table-striped table-light table-hover table-fixed"
            id="table-employees"
          >
            <thead class="thead-primary">
              <tr class="bg-gradient-primary text-white text-center">
                <th>
                  <i class="fas fa-sort-numeric-down-alt"></i>
                  <br />ID:
                </th>
                <th>Nombre:</th>
                <th>UGDN:</th>
                <th>Estado:</th>
                <th>Ubicación:</th>
                <th>Acciones:</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(employee, index) in searchEmployee" :key="index">
                <td>
                  <div class="col-auto text-center">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <div class="mb-0 font-weight-bold text-gray-700">{{ employee.id }}</div>
                  </div>
                </td>
                <td>
                  <div class="col-auto text-center">
                    <img
                      class="img-fluid rounded-circle"
                      :src="`../storage/Employees-avatar/${employee.profile_avatar}`"
                      alt="avatarEmployeeImage"
                      width="40px"
                    />
                    <div class="mb-0 font-weight-bold text-gray-700">{{ employee.name }}</div>
                  </div>
                </td>
                <td>
                  <div class="col-auto text-center">
                    <div class="mb-0 font-weight-bold text-gray-600">
                      <i class="fa fa-fingerprint"></i>
                      <br />
                      {{ employee.ugdn }}
                      <br />
                      CC: {{ employee.citizenship_card }}
                    </div>
                  </div>
                </td>
                <td>
                  <div class="col-auto text-center">
                    <div class="mb-0 font-weight-bold text-gray-700">
                      {{ employee.work_area }}
                      <br />
                      {{ employee.employee_type }}
                    </div>
                    <span
                      v-if="employee.status === 'Activo'"
                      class="badge badge-success"
                    >{{ employee.status }}</span>
                    <span v-else class="badge badge-danger">{{ employee.status }}</span>
                  </div>
                </td>
                <td>
                  <div class="col-auto text-center">
                    <div class="mb-0 font-weight-bold text-gray-700">
                      <i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                      <br />
                      {{ employee.country }} / {{ employee.city }}
                      <br />
                      <i class="fas fa-phone"></i>
                      {{ employee.phone }}
                    </div>
                  </div>
                </td>
                <td>
                  <!-- Button trigger modal -->
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#exampleModalCenter"
                  >Asignar</button>
                  <!-- Modal -->
                  <div
                    class="modal fade"
                    id="exampleModalCenter"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true"
                  >
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                          <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                          >
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <computers-component />
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const urlBase = "http://localhost:8000/api/employees";
import ComputersComponent from "./ComputersComponent";
export default {
  components: {
    "computers-component": ComputersComponent
  },

  created() {
    axios.get(urlBase).then(response => {
      this.employees = response.data;
    });
  },
  data() {
    return {
      employees: [],
      search: ""
    };
  },

  computed: {
    searchEmployee() {
      return this.employees.filter(employee => {
        return employee.name.toLowerCase().includes(this.search.toLowerCase());
      });
    }
  }
};
</script>
