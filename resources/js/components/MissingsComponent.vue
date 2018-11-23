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
                        <p v-if="remainings.length == 0"><strong>No hay faltantes todavía.</strong></p>
                        <p v-if="remainings.length > 0" v-for="remaining in remainings">- <strong>DNI:</strong> {{ remaining.dni }} | <strong>Nombre y apellido:</strong> {{ remaining.name_lastname }} | <strong>Domicilio:</strong> {{ remaining.address }}</p>
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

      remainings: {}
    };
  },
  methods: {
    getRemainings: function() {
      var urlGetRemainings = this.base_url + "/remaining/";
      axios
        .get(urlGetRemainings)
        .then(response => {
          this.remainings = response.data;
          console.log(this.remainings);
        })
        .catch(error => {
          console.log(error);
        });
    },
    postClosing: function() {
      var urlPostClosing = this.base_url + "/closings/";

      axios({
        url: urlPostClosing,
        type: "post",
        method: "post",
        dataType: "json",
        data: {
          _token: this.token
        }
      })
        .then(response => {
          this.getClosings();
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  created: function() {
    this.getRemainings();
  }
};
</script>
