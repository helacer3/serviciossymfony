<template>
	<div class="row">
		<div class="col-12 alert alert-danger" v-show="errDisplay">{{errMessage}}</div>
		<div class="col-12 alert alert-success" v-show="sucDisplay">Wallet Cargada Correctamente</div>
		<div class="col-12"><h1>Recargar billetera</h1></div>
		<div class="col-6">
			<label>Documento</label>
			<input type="text" name="usrDocument" v-model="usrDocument" placeholder="Documento del Usuario" value="">
		</div>
		<div class="col-6">
			<label>Teléfono</label>
			<input type="text" name="usrPhone" v-model="usrPhone" placeholder="Teléfono del Usuario" value="">
		</div>
		<div class="col-6">
			<label>Valor</label>
			<input type="number" name="usrValue" v-model="usrValue" placeholder="Valor a recargar" value="">
		</div>
		<div class="col-12 text-center">
			<button v-on:click="rechargeWallet">Cargar Billetera</button>
		</div>
	</div>
</template>
<script>
	import axios from "axios";
	export default {
	  name: "wallet",
	  data() {
	    return {
	    	errMessage: 'Favor diligencie los datos de la recarga',
	    	usrDocument: '',
	    	usrPhone: '',
	    	usrValue: 10000,
        	errDisplay: false,
        	sucDisplay: false
	    };
	  },
	  mounted() {
	  },
	  methods: {
	  	// recharge Wallet
	  	rechargeWallet(e) {
	  		if (this.usrDocument == '' || this.usrPhone == '' || this.usrValue == 0) {
	  			this.errDisplay = true;
	  			this.sucDisplay = false;
  			} else {
  				this.apiRechargeValue(e);
	  		}
	  	},
	  	// api Recharge Value
	  	apiRechargeValue(e) {
	  		e.preventDefault();
	  		let cm = this;
	        // ajax Request
	        axios.post('http://localhost/soapSymfony/public/api/rechargeWallet', {
				headers: { 'Content-Type': 'multipart/form-data' },
				params: {
					usrDocument: this.usrDocument,
					usrPhone: this.usrPhone,
					usrValue: this.usrValue
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