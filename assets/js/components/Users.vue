<template>
	<div class="row">
		<div class="col-12 alert alert-danger" v-show="errDisplay">{{errMessage}}</div>
		<div class="col-12 alert alert-success" v-show="sucDisplay">Usuario Creado Correctamente</div>
		<div class="col-12"><h1>Registrar Usuario</h1></div>
		<div class="col-6">
			<label>Usuario</label>
			<input type="text" name="usrName" v-model="usrName" placeholder="Nombre del Usuario" value="">
		</div>
		<div class="col-6">
			<label>Documento</label>
			<input type="text" name="usrDocument" v-model="usrDocument" placeholder="Documento del Usuario" value="">
		</div>
		<div class="col-6">
			<label>Correo Electrónico</label>
			<input type="email" name="usrEmail" v-model="usrEmail" placeholder="Correo del Usuario" value="">
		</div>
		<div class="col-6">
			<label>Teléfono</label>
			<input type="text" name="usrPhone" v-model="usrPhone" placeholder="Teléfono del Usuario" value="">
		</div>
		<div class="col-12 text-center">
			<button v-on:click="saveUser">Crear Cliente</button>
		</div>
	</div>
</template>
<script>
	import axios from "axios";
	export default {
	  name: "users",
	  data() {
	    return {
	    	errMessage: 'Favor diligencie los datos',
	    	usrName: '',
	    	usrDocument: '',
	    	usrEmail: '',
	    	usrPhone: '',
        	errDisplay: false,
        	sucDisplay: false
	    };
	  },
	  mounted() {
	  },
	  methods: {
	  	// save User
	  	saveUser(e) {
	  		if (this.usrName == '' || this.usrDocument == '' || this.usrPhone == '' || this.usrEmail == '') {
	  			this.errDisplay = true;
	  			this.sucDisplay = false;
  			} else {
  				this.apiSaveUser(e);
	  		}
	  	},
	  	// api Save User
	  	apiSaveUser(e) {
	  		e.preventDefault();
	  		let cm = this;
	        // ajax Request
	        axios.post('http://localhost/soapSymfony/public/api/registerUser', {
				headers: { 'Content-Type': 'multipart/form-data' },
				params: {
					usrName: this.usrName,
					usrDocument: this.usrDocument,
					usrEmail: this.usrEmail,
					usrPhone: this.usrPhone
				}
	        })
	        .then(function (response) {
	  			cm.sucDisplay = true;
	  			cm.errDisplay = false;
	        })
	        .catch(function (error) {
	        	cm.errMessage = 'Ocurrió un error al guardar';
	  			cm.sucDisplay = false;
	  			cm.errDisplay = true;
	        });
	  	}
	  }
	};
</script>

<style>
.center {
  text-align: center;
}
</style>