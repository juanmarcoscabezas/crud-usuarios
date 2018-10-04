new Vue({
    el: '#app',
    data: {
        nombre: "",
        correo: "",
        nombreUpdate: "",
        correoUpdate: "",
        modId: -1,
        consulta: [],
        errores: []
    },
    created: function() {
        this.consultar();
    },
    methods: {
        consultar: function() {
            const vue = this;
            axios.get('./servidor/entradas.php?action=get')
                .then(function(response) {
                    vue.consulta = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        crear: function() {
            this.validarCrear();
            if (this.errores.length === 0) {
                const vue = this;
                var usuario = {
                    nombre: this.nombre,
                    correo: this.correo
                };
                axios.post('./servidor/entradas.php?action=post', JSON.stringify(usuario))
                    .then(function(response) {
                        vue.consulta = response.data;
                        vue.nombre = "";
                        vue.correo = "";
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        },
        modificar: function(usuario) {
            this.modId = usuario.id;
            this.nombreUpdate = usuario.nom;
            this.correoUpdate = usuario.correo;
        },
        actualizar: function(id) {
            this.validarActualizar();
            if (this.errores.length === 0) {
                const vue = this;
                var usuario = {
                    id: id,
                    nombre: this.nombreUpdate,
                    correo: this.correoUpdate
                };
                axios.post('./servidor/entradas.php?action=update', JSON.stringify(usuario))
                    .then(function(response) {
                        vue.consulta = response.data;
                        vue.modId = -1;
                        vue.nombreUpdate = "";
                        vue.correoUpdate = "";
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        },
        eliminar: function(id) {
            console.log(id);
            var data = {
                id: id
            };
            const vue = this;
            axios.post('./servidor/entradas.php?action=delete', JSON.stringify(data))
                .then(function(response) {
                    vue.consulta = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        validarCrear: function() {
            this.errores = [];
            if (this.validCampo(this.nombre) == false) this.errores.push("El campo nombre es requerido");
            if (this.validCampo(this.correo) == false) this.errores.push("El campo correo es requerido");
            else if (this.validEmail(this.correo) == false) this.errores.push("El campo correo no es válido");
        },
        validarActualizar: function() {
            this.errores = [];
            if (this.validCampo(this.nombreUpdate) == false) this.errores.push("El campo nombre es requerido");
            if (this.validCampo(this.correoUpdate) == false) this.errores.push("El campo correo es requerido");
            else if (this.validEmail(this.correoUpdate) == false) this.errores.push("El campo correo no es válido");
        },
        validCampo: function(campo) {
            if (campo == null || campo == 0 || /^\s+$/.test(campo)) {
                return false
            }
        },
        validEmail: function(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    }
})