<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!--Axios-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!--Vue Js-->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!--Jquery Mask-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
</head>

<body>
    <div id="table">
        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Select</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="#" data-toggle="modal" data-target="#InsertModal">Insert</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="#" data-toggle="modal" data-target="#addEspModal">Adicionar Especionalidade</a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Procurar (nome/rm)" aria-label="Search" v-model="search">

                </form>
            </div>
        </nav>
        <!-- Fim NavBar -->
        <!-- Tabela -->
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CRM</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Telefones</th>
                        <th scope="col">Especialidades</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="medico in filteredMedicos">
                        <th scope="row">
                            
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{medico.id_medico}}
                                    </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#EditModal" v-on:click="SetMed(medico.id_medico)">Editar</button>
                                    <button class="dropdown-item" type="button" v-on:click="DelMed(medico.id_medico)">Excluir</button>
                                </div>
                            </div>
                        </th>
                        <td>{{medico.nome_medico}}</td>
                        <td>{{medico.crm_medico}}</td>
                        <td>{{medico.dn_medico}}</td>
                        <td>

                            <div class="input-group">
                                <select class="form-control form-control-sm" v-model="selecionado" placeholder="XXXX-XXXX">

                                    <option v-for="telefone in telefones" v-if="telefone.id_medico == medico.id_medico" :value="telefone.id_telefone">{{telefone.numero}}</option>
                                </select>
                                <!--DropDown Telefone-->
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Edit
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#exampleModal" v-on:click="SetEditTel">Editar</button>
                                        <button class="dropdown-item" type="button" v-on:click="DeleteTel">Excluir</button>
                                        <button class="dropdown-item" type="button" v-on:click="SetMed(medico.id_medico)" data-toggle="modal" data-target="#addTelModal">Adicionar</button>
                                    </div>
                                </div>
                                <!--Fim DropDown Telefone-->
                            </div>
                        </td>

                        <td>
                            <div class="input-group">
                                <select class="form-control form-control-sm" v-model="seletor2">
                                    <option v-for="especialidade in especialidades" v-if="especialidade.id_medico == medico.id_medico" v-bind:value="{id_esp: especialidade.id_especialidade, id_med: medico.id_medico, id_espmeds: especialidade.id_esp_med}">{{especialidade.nome_especialidade}}</option>
                                </select>
                                <!--DropDown-->
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Edit
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button" data-target="#editEspModal" data-toggle="modal">Editar</button>
                                        <button class="dropdown-item" type="button" v-on:click="DeleteEspMeds">Excluir</button>
                                        <button class="dropdown-item" type="button" v-on:click="SetMed(medico.id_medico)" data-target="#AddEspModal" data-toggle="modal">Adicionar</button>
                                    </div>
                                </div>
                                <!--Fim DropDown-->
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Fim Tabela -->

        <!--Modal Editar Telefone-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Telefone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Telefone</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Telefone" aria-label="Username" aria-describedby="basic-addon1"  @keypress="onlyNumber" v-model="tel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="EditTel" data-dismiss="modal">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim Modal Editar Telefone-->

        <!--Modal Adicionar Telefone-->
        <div class="modal fade" id="addTelModal" tabindex="-1" aria-labelledby="addTelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTelModalLabel">Adicionar Telefone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Telefone</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Telefone" aria-label="Username" aria-describedby="basic-addon1"  @keypress="onlyNumber" v-model="tel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="AddTel" data-dismiss="modal">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim Modal Adicionar Telefone-->

        <!--Modal Editar Especialidade-->
        <div class="modal fade" id="editEspModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Especialidade</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Especialidade</span>
                            </div>
                            <select class="custom-select" v-model="IdEspMeds">
                                
                                <option v-for="especialidade in especialidadess" :value="especialidade.id_especialidade">{{especialidade.nome_especialidade}}</option>

                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="EditEspMeds" data-dismiss="modal">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim Modal Editar Especialidade-->

        <!--Modal Adicionar Especialidade-->
        <div class="modal fade" id="AddEspModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Especialidade</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Especialidade</span>
                            </div>
                            <select class="custom-select" v-model="IdEspMeds">
                                
                                <option v-for="especialidade in especialidadess" :value="especialidade.id_especialidade">{{especialidade.nome_especialidade}}</option>

                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="AddEspMeds" data-dismiss="modal">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim Modal Adicionar Especialidade-->
        <!-- Modal Insert Medico-->
        <div class="modal fade" id="InsertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="InsertModalLabel">Inserir Medico</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nome</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Nome do Medico" aria-label="Username" aria-describedby="basic-addon1" @keypress="onlyLetter" v-model="nomeMed">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">CRM&nbsp;&nbsp;</span>
                                </div>
                                <input type="text" class="form-control" placeholder="XXXXXXXXXX" aria-label="Username" aria-describedby="basic-addon1" v-model="crmNum" @keypress="sizeLimit">
                                <select class="custom-select" v-model="crmUf">
                                    <option value="/RO">/RO</option>
                                    <option value="/AC">/AC</option>
                                    <option value="/AM">/AM</option>
                                    <option value="/RR">/RR</option>
                                    <option value="/PA">/PA</option>
                                    <option value="/AP">/AP</option>
                                    <option value="/TO">/TO</option>
                                    <option value="/MA">/MA</option>
                                    <option value="/PI">/PI</option>
                                    <option value="/CE">/CE</option>
                                    <option value="/RN">/RN</option>
                                    <option value="/PB">/PB</option>
                                    <option value="/PE">/PE</option>
                                    <option value="/AL">/AL</option>
                                    <option value="/SE">/SE</option>
                                    <option value="/BA">/BA</option>
                                    <option value="/MG">/MG</option>
                                    <option value="/ES">/ES</option>
                                    <option value="/RJ">/RJ</option>
                                    <option value="/SP">/SP</option>
                                    <option value="/PR">/PR</option>
                                    <option value="/SC">/SC</option>
                                    <option value="/RS">/RS</option>
                                    <option value="/MS">/MS</option>
                                    <option value="/MT">/MT</option>
                                    <option value="/GO">/GO</option>
                                    <option value="/DF">/DF</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Especialidades</span>
                                </div>
                                <select class="custom-select" v-model="esp1_select">
                                    
                                    <option v-for="especialidade in especialidadess" :value="especialidade.id_especialidade">{{especialidade.nome_especialidade}}</option>

                                </select>
                                <select class="custom-select" v-model="esp2_select">
                                    
                                    <option v-for="especialidade in especialidadess" :value="especialidade.id_especialidade">{{especialidade.nome_especialidade}}</option>

                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Telefone</span>
                                </div>
                                <input type="text" class="form-control" placeholder="(xx) x xxxx-xxxx" aria-label="Username" aria-describedby="basic-addon1" @keypress="onlyNumber" v-model="tel">

                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Data de Nascimento</span>
                                </div>
                                <input type="date" class="form-control" v-model="dnMedico">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="InserirMedico" data-dismiss="modal">Inserir</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim Modal Insert Medico-->
        <!-- Modal Edit Medico-->
        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditModalLabel">Editar Medico</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nome</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Nome do Medico" aria-label="Username" aria-describedby="basic-addon1" @keypress="onlyLetter" v-model="nomeMed">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">CRM&nbsp;&nbsp;</span>
                                </div>
                                <input type="text" class="form-control" placeholder="XXXXXXXXXX" aria-label="Username" aria-describedby="basic-addon1" v-model="crmNum" @keypress="sizeLimit">
                                <select class="custom-select" v-model="crmUf">
                                    <option value="/RO">/RO</option>
                                    <option value="/AC">/AC</option>
                                    <option value="/AM">/AM</option>
                                    <option value="/RR">/RR</option>
                                    <option value="/PA">/PA</option>
                                    <option value="/AP">/AP</option>
                                    <option value="/TO">/TO</option>
                                    <option value="/MA">/MA</option>
                                    <option value="/PI">/PI</option>
                                    <option value="/CE">/CE</option>
                                    <option value="/RN">/RN</option>
                                    <option value="/PB">/PB</option>
                                    <option value="/PE">/PE</option>
                                    <option value="/AL">/AL</option>
                                    <option value="/SE">/SE</option>
                                    <option value="/BA">/BA</option>
                                    <option value="/MG">/MG</option>
                                    <option value="/ES">/ES</option>
                                    <option value="/RJ">/RJ</option>
                                    <option value="/SP">/SP</option>
                                    <option value="/PR">/PR</option>
                                    <option value="/SC">/SC</option>
                                    <option value="/RS">/RS</option>
                                    <option value="/MS">/MS</option>
                                    <option value="/MT">/MT</option>
                                    <option value="/GO">/GO</option>
                                    <option value="/DF">/DF</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Data de Nascimento</span>
                                </div>
                                <input type="date" class="form-control" v-model="dnMedico">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="EditMed" data-dismiss="modal">Editar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim Modal Edit Medico-->
        <!--Modal Insert Esp-->
        <div class="modal fade" id="addEspModal" tabindex="-1" aria-labelledby="addTelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTelModalLabel">Adicionar Especionalidade</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Especionalidade</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Especionalidade" aria-label="Username" aria-describedby="basic-addon1" v-model="nomeEsp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="InserirEsp" data-dismiss="modal">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal Final Insert Esp-->
    </div>




    <script>
        var app = new Vue({

            el: '#table',
            data: {
                medicos: [],
                telefones: [],
                especialidades: [],
                especialidadess: [],
                search: '',
                idMed: 0,
                selecionado: '',
                IdEspMeds: '',
                seletor2: '',
                tel: '',
                crmNum: '',
                esp1_select: '',
                esp2_select: '',
                nomeMed: '',
                dnMedico: '',
                crmUf: '',
                nomeEsp: ''


            },
            mounted: function() {
                axios.get('/api/medicos/').then(response => {
                    this.medicos = response.data;

                    axios.get('/api/telefones/').then(responseTel => {
                        this.telefones = responseTel.data;

                        axios.get('/api/especialidades/').then(responseEsp => {
                            this.especialidades = responseEsp.data;
                            axios.get('/api/especialidades/1').then(responseEsp => {
                                this.especialidadess = responseEsp.data;

                            }).catch(error => {
                                console.log(error);
                                alert("Ocorreu um erro interno, acompanhe pelo console :(");
                            })
                        }).catch(error => {
                            console.log(error);
                            alert("Ocorreu um erro interno, acompanhe pelo console :(");
                        })

                    }).catch(error => {
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })

                }).catch(error => {
                    console.log(error);
                    alert("Ocorreu um erro interno, acompanhe pelo console :(");
                })





            },
            computed: {
                filteredMedicos: function() {
                    return this.medicos.filter((medico) => {
                        if (medico.nome_medico.toLowerCase().match(this.search.toLowerCase()) || medico.crm_medico.match(this.search))
                            return true;
                    })
                }
            },
            methods: {
                EditTel: function() {



                    axios.patch('/api/telefones/' + this.selecionado, {
                        numero: this.tel
                    }).then(response => {

                        window.location.reload();
                    }).catch(error => {
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })
                },
                SetEditTel: function() {
                    this.telefones.filter((telefone) => {
                        if (telefone.id_telefone == this.selecionado) {
                            this.tel = telefone.numero;
                        }
                    })
                },
                DeleteTel: function() {
                    axios.delete('/api/telefones/' + this.selecionado).then(response => {
                        
                        window.location.reload();
                    }).catch(error => {
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })
                },
                SetMed: function(id) {
                    this.idMed = id;
                },
                AddTel: function() {
                    axios.post('/api/telefones/', {
                        numero: this.tel,
                        id_medico: this.idMed
                    }).then(response => {
                        
                        window.location.reload();
                    }).catch(error => {
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })
                },
                EditEspMeds: function() {

                    axios.patch('/api/espmed/' + this.seletor2.id_espmeds, {
                        id_especialidade: this.IdEspMeds,
                        id_medico: this.seletor2.id_med
                    }).then(response => {
                        
                        window.location.reload();
                    }).catch(error => {
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })
                },
                DeleteEspMeds: function() {
                    axios.delete('/api/espmed/' + this.seletor2.id_espmeds).then(response => {
                        
                        window.location.reload();
                    }).catch(error => {
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })
                },
                AddEspMeds: function() {


                    axios.post('/api/espmed/', {
                        id_especialidade: this.IdEspMeds,
                        id_medico: this.idMed

                    }).then(response => {
                        
                        window.location.reload();
                    }).catch(error => {
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })


                },
                onlyNumber($event) {

                    let keyCode = ($event.keyCode ? $event.keyCode : $event.which);

                    if (this.tel.length >= 11) {
                        $event.preventDefault();
                    }
                    if ((keyCode < 48 || keyCode > 57)) {
                        $event.preventDefault();

                    }
                },
                sizeLimit($event) {
                    if (this.crmNum.length >= 10) {
                        $event.preventDefault();
                    }
                    let keyCode = ($event.keyCode ? $event.keyCode : $event.which);

                    if ((keyCode < 48 || keyCode > 57)) {
                        $event.preventDefault();

                    }
                },
                onlyLetter($event) {

                    let keyCode = ($event.keyCode ? $event.keyCode : $event.which);

                    if (!(keyCode < 48 || keyCode > 57)) {
                        $event.preventDefault();
                    }
                },
                InserirMedico: function() {
                    //alert(this.dnMedico);

                    if (this.nomeMed.length <= 5) {
                        alert("Coloque um nome!!!");
                        return;
                    }
                    if (this.crmNum.length < 4) {
                        alert('CRM invalido!!!');
                        return;
                    }
                    if (!this.crmUf) {
                        alert("Selecione uma UF!!!");
                        return;
                    }
                    if (!this.dnMedico){
                        alert('Insira uma data de nascimento!!');
                        return;
                    }
                    if (!this.esp1_select) {
                        alert("Selecione ao menos duas especialidades!!!");
                        return;
                    }
                    if (!this.esp2_select) {
                        alert("Selecione ao menos duas especialidades!!!");
                        return;
                    }

                    if (this.esp1_select == this.esp2_select) {
                        alert("Selecione Especialidades diferentes!!!");
                        return;
                    }

                    if (this.tel.length < 10) {
                        alert("Insira um telefone valido com DDD!!!");
                        return;
                    }

                    axios.post('/api/medicos/', {
                        nome_medico: this.nomeMed,
                        dn_medico: this.dnMedico,
                        crm_medico: this.crmNum + this.crmUf
                    }).then(response => {
                        //retornar id do medico pela api
                        let id = response.data[0].id_medico;
                        axios.post('/api/telefones/', {
                            numero: this.tel,
                            id_medico: id
                        }).then(response => {
                            
                            axios.post('/api/espmed/', {
                                id_medico: id,
                                id_especialidade: this.esp1_select
                            }).then(response => {
                                
                                axios.post('/api/espmed/', {
                                    id_medico: id,
                                    id_especialidade: this.esp2_select
                                }).then(response => {
                                    
                                    window.location.reload();
                                }).catch(error => {
                                    console.log(error);
                                    alert("Ocorreu um erro interno, acompanhe pelo console :(");
                                })
                            }).catch(error => {
                                console.log(error);
                                alert("Ocorreu um erro interno, acompanhe pelo console :(");
                            })
                        }).catch(error => {
                            console.log(error);
                            alert("Ocorreu um erro interno, acompanhe pelo console :(");
                        })
                    }).catch(error => {
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })
                },
                DelMed: function(id){
                    axios.delete('/api/medicos/'+id).then(response=>{
                        
                        window.location.reload();
                    }).catch(error=>{
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })
                },
                EditMed: function(){
                    if (this.nomeMed.length <= 5) {
                        alert("Coloque um nome!!!");
                        return;
                    }
                    if (this.crmNum.length < 4) {
                        alert('CRM invalido!!!');
                        return;
                    }
                    if (!this.crmUf) {
                        alert("Selecione uma UF!!!");
                        return;
                    }
                    if (!this.dnMedico){
                        alert('Insira uma data de nascimento!!');
                        return;
                    }
                    axios.patch('/api/medicos/'+this.idMed, {
                        nome_medico: this.nomeMed,
                        dn_medico: this.dnMedico,
                        crm_medico: this.crmNum + this.crmUf
                     }).then(response=>{
                         
                         window.location.reload();
                     }).catch(error=>{
                         console.log(error);
                         alert("Ocorreu um erro interno, acompanhe pelo console :(");
                     })
                },
                InserirEsp: function(){
                    axios.post('/api/especialidades/',{nome_especialidade: this.nomeEsp}).then(response=>{
                        
                        window.location.reload();
                    }).catch(error=>{
                        console.log(error);
                        alert("Ocorreu um erro interno, acompanhe pelo console :(");
                    })
                }


            }
        })
    </script>
</body>

</html>