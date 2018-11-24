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

      username: "",
      isLoader: "",

      success: false
    };
  },
  methods: {
    cleanErrors: function() {
      this.errors = "";
      this.success = false;
    },
    validateForm: function() {
      if (this.acutualDni.length < 4) {
        this.errors = "El dni es demasiado corto.";
      } else if (this.acutualDni.length == "") {
        this.errors = "Por favor, completar el campo.";
      } else {
        this.postDni();
      }
    },
    getAuthUserName: function() {
      var authUrl = this.base_url + "/users/username/";
      axios
        .get(authUrl)
        .then(response => {
          this.username = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getIsloader: function() {
      var urlIsLoader = this.base_url + "/users/isloader/";
      axios
        .get(urlIsLoader)
        .then(response => {
          this.isLoader = response.data;
          if(!this.isLoader) {
            window.location.replace(this.base_url + '/faltantes');
          } 
        })
        .catch(error => {
          console.log(error);
        });
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
          dni: this.acutualDni,
          registed_by: this.username
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
  created: function() {
    this.getAuthUserName();
    this.getIsloader();
  }
};
</script>
