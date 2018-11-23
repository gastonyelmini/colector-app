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
                          <p>Buscar por <strong>nombre</strong>, <strong>apellido</strong>, <strong>DNI</strong> o <strong>domicilio</strong></p>
                          <input v-model="search" type="text" placeholder="Buscar">
                        </div>
                        <p v-if="remainings.length == 0"><strong>No hay faltantes todavía.</strong></p>
                        <p v-if="filteredNames.length > 0" v-for="remaining in filteredNames">- <strong>DNI:</strong> {{ remaining.dni }} | <strong>Nombre y apellido:</strong> {{ remaining.name_lastname }} | <strong>Domicilio:</strong> {{ remaining.address }}</p>
                        <p v-if="remainings.length > 0 && filteredNames.length == 0">No hay resultados para la busqueda.</p>
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

      search: ""
    };
  },
  methods: {
    getRemainings: function() {
      var urlGetRemainings = this.base_url + "/remaining/";
      axios
        .get(urlGetRemainings)
        .then(response => {
          this.remainings = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  created: function() {
    this.getRemainings();
  },
  computed: {
    filteredNames() {
      return this.remainings.filter(rmdObject => {
        var filterData =
          rmdObject.name_lastname + rmdObject.dni + rmdObject.address;
        return filterData.toLowerCase().includes(this.search.toLowerCase());
      });
    }
  }
};
</script>
