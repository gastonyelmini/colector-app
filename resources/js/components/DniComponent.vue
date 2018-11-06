<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ingresar documento sin puntos</div>

                    <div class="card-body">
        
                        <form method="POST" v-on:submit.prevent="validateForm">
                            <input pattern="\d*" type="number" name="dni" placeholder="Ej: 38155143" class="docInput" required v-model="acutualDni" v-on:click.prevent="cleanErrors">
                            <button type="submit" class="submitDoc">Enviar</button>
                        </form>

                        <div>
                            <span class="invalid-feedback main-error" role="alert" >
                                <strong>{{ errors }}</strong>
                            </span>

                            <span class="invalid-feedback main-error" role="alert" id="success" v-if="success">
                                <strong>Documento enviado correctamente</strong>
                            </span>
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

      acutualDni: "",

      errors: "",

      success: false
    };
  },
  methods: {
    cleanErrors: function() {
      this.errors = "";
      this.success = false;
    },
    validateForm: function() {
      if (this.acutualDni.length < 8) {
        this.errors = "El dni es demasiado corto.";
      } else if (this.acutualDni.length == "") {
        this.errors = "Por favor, completar el campo.";
      } else {
        this.postDni();
      }
    },
    postDni: function() {
      var urlCreateNewDni = this.base_url + "/dnis/";

      axios({
        url: urlCreateNewDni,
        type: "post",
        method: "post",
        dataType: "json",
        data: {
          _token: this.token,
          dni: this.acutualDni
        }
      })
        .then(response => {
          this.acutualDni = "";
          this.success = true;
        })
        .catch(error => {
          alert("Error");
          console.log(error);
          this.success = false;
        });
    }
  },
  created: function() {}
};
</script>
