<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      Registro de cierres
                    </div>

                    <div class="card-body">
                      <button type="submit" class="submitDoc" v-on:click.prevent="postClosing()">Nuevo cierre de datos</button>
                      <div class="closings-list">
                        <p v-if="closings.length == 0"><strong>No hay cierres todavía.</strong></p>
                        <p v-if="closings.length > 0" v-for="closing in closings">- Cierre de datos en la fecha <strong>{{ closing.created_at | moment("DD, MMMM YYYY") }}</strong>.</p>
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

      closings: {}
    };
  },
  methods: {
    getClosings: function() {
      var closingsUrl = this.base_url + "/closings/";
      axios
        .get(closingsUrl)
        .then(response => {
          this.closings = response.data;
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
    this.getClosings();
  }
};
</script>
