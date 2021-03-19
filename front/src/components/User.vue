<template>
    <section class="json-container bg-light">
        <div class="container">
            <div class="row mb-2">
                <div class="col">
                    <button type="button" class="btn btn-primary float-end mt-4" @click="openModal('CadUser')">+ Usuário</button>
                </div>
            </div>

            <div v-bind:class="['alert',  message.class]" role="alert" v-if="message.mensagem !== ''">
                {{message.mensagem}}
            </div>

            <div class="row mb-2">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nome</th>
                                <th>email</th>
                                <th>status</th>
                                <th colspan="2">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user of users" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.status === 1 ? 'Ativo' : 'inativo'}}</td>
                                <td class="acao" @click="openUser(user)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </td>
                                <td class="acao" @click="openDeleteModal(user)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                    </svg>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="CadUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="CadUser">
        <div class="modal-dialog">
            <div class="modal-content">
            <form @submit.prevent="actionForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{titleModalForm}}</h5>
                    <button type="button" class="btn-close" @click="hideModal('CadUser')" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        <input placeholder="Nome do usuário" type="text" name="name" v-model="user.name" class="form-control" required/>
                    </p>
                    <p>
                        <input placeholder="email" type="email" name="email" class="form-control" required v-model="user.email"/>
                    </p>
                    <p v-if="!user.id">
                        <input placeholder="Senha" type="password" name="password" class="form-control" required v-model="user.password"/>
                    </p>
                    <p>
                        <select class="form-select" aria-label="Default select example" v-model="user.status" required>
                            <option value="">Status</option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="hideModal('CadUser')">Close</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="deleteUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deletar usuário</h5>
                    <button type="button" class="btn-close" @click="hideModal('deleteUser')" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja deletar o usuário <strong>{{user.name}}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="hideModal('deleteUser')">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click="deleteUser">Continuar</button>
                </div>
            </div>
        </div>
    </div>
            
</template>


<script>
    
    import Users from '../services/users'

    export default {

        data() {
            return {
                users: [],
                user: {
                    'id': '',
                    'name': '',
                    'email': '',
                    'status': '',
                    'password': ''
                },
                titleModalForm: String,
                message: {
                    'class': '',
                    'mensagem': ''
                }
            }
        },

        mounted() {
            this.getAllUsers()
            this.titleModalForm = 'Inserir novo usuário'
        },

        methods:{
            async getAllUsers() {
                Users.getAllUsers().then(res => {
                    this.users = res.data
                }, (error) => {
                    this.message.class = 'alert-danger'
                    this.message.mensagem = 'Erro de conectar com o servidor, por favor tente mais tarde!'
                })
            },

            async actionForm(){
                if(this.user.id) {
                    await this.updateUser()
                } else {
                    await this.createUser()
                }
                await this.hideModal('CadUser')
                await this.getAllUsers()
            },

            async createUser(){
                await Users.createUser(this.user).then(res => {
                    this.message.class = 'alert-success'
                    this.message.mensagem = 'Usuário cadastrado com sucesso!'
                }, (error) => {
                    this.message.class = 'alert-danger'
                    this.message.mensagem = 'Erro de conectar com o servidor, por favor tente mais tarde!'
                })
            },

            async updateUser() {
                await Users.updateUser(this.user).then(res => {
                    this.message.class = 'alert-success'
                    this.message.mensagem = 'Usuário atualizado com sucesso!'
                }, (error) => {
                    this.message.class = 'alert-danger'
                    this.message.mensagem = 'Erro de conectar com o servidor, por favor tente mais tarde!'
                })
            },

            async deleteUser() {
                console.log(this.user)
                await Users.deleteUser(this.user).then(res => {
                    this.message.class = 'alert-success'
                    this.message.mensagem = 'Usuário deletado com sucesso!'
                }, (error) => {
                    this.message.class = 'alert-danger'
                    this.message.mensagem = 'Erro de conectar com o servidor, por favor tente mais tarde!'
                })
                this.user = {}
                await this.hideModal('deleteUser')
            },

           async hideModal(idModal) {
                this.user = {}
                await this.getAllUsers()
                $(`#${idModal}`).modal('hide')
            },

            openModal(idModal) {
                $(`#${idModal}`).modal('show')
            },

            openUser(user) {
                this.user = user
                this.titleModalForm = 'Editar usuário'
                this.openModal('CadUser')
            },

            openDeleteModal(user) {
                this.user = user
                this.openModal('deleteUser')
            }
        }
    }   

</script>

<style>
.acao {
    cursor: pointer;
}
</style>