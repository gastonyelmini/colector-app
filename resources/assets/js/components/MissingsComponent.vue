<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      Faltan votar:
                    </div>

                    <div class="card-body">
                      <div class="closings-list">
                        <div class="search-input">
                          <p>Buscar por <strong>nombre</strong>, <strong>apellido</strong> o <strong>DNI</strong></p>
                          <input v-model="search" type="text" placeholder="Buscar">
                        </div>
                        <p v-if="remainings.length == 0 && this.loading == false" ><strong>No hay faltantes todavía.</strong></p>
                        <p v-if="filteredNames.length > 0" v-for="remaining in filteredNames">- <strong>DNI:</strong> {{ remaining.dni }} | <strong>Nombre y apellido:</strong> {{ remaining.name_lastname }} | <strong>Domicilio:</strong> {{ remaining.address }} | <strong>Referente:</strong> {{ remaining.registed_by }}</p>
                        <p v-if="remainings.length > 0 && filteredNames.length == 0">No hay resultados para la busqueda.</p>
                        <p class="invalid-feedback main-error" v-if="loading">CARGANDO DATOS</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      base_url: window.location.origin,
      token: $('meta[name="csrf-token"]').attr("content"),

      remainings: [],

      search: "",

      loading: false
    };
  },
  methods: {
    getRemainings: function() {
      var urlGetRemainings = this.base_url + "/remaining/";

      this.loading = true;
      axios
        .get(urlGetRemainings)
        .then(response => {
          this.remainings = response.data;
          this.loading = false;
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        });
    }
  },
  created: function() {
    this.getRemainings();
  },
  computed: {
    filteredNames() {
      return Object.values(this.remainings).filter(rmdObject => {
        var filterData = rmdObject.name_lastname + " " + rmdObject.dni;
        return filterData.toLowerCase().includes(this.search.toLowerCase());
      });
    }
  }
};
</script>
