<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Movie list</h2>
                <h3><button class="btn btn-success" data-toggle="modal" data-target="#memberModal">Create</button></h3>

            </div>
            <div class="box-body">
                <table id="memberTables" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>Lc Number</th>
                        <th>Joined On</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>


                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(member, index) in members">
                        <td>{{member.name}}</td>
                        <td>{{member.age}}</td>
                        <td>{{member.address}}</td>
                        <td>{{member.telephone}}</td>
                        <td>{{member.lc_number}}</td>
                        <td>{{member.date_of_joined}}</td>
                        <td v-if="member.is_active === 0"><span class="label label-primary">Not Active</span></td>
                        <td v-if="member.is_active === 1"><span class="label label-success">Active</span></td>

                        <td><button class="btn btn-info" @click="editForm(member.id)">Edit</button></td>
                        <td><button class="btn btn-danger" @click="deleteData(member.id, index)">Delete</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="memberModal" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 b-r">
                                <form role="form" v-on:submit.once.prevent="handleSubmit()">
                                    <input v-model="member.id" type="hidden"
                                           class="form-control val-text"/>
                                    <div class="form-group">
                                        <input v-model="member.name" type="text"
                                               placeholder="Enter Name" class="form-control val-text"/>
                                    </div>
                                    <div class="form-group">
                                        <input v-model="member.age" type="number"
                                               placeholder="Enter Age" class="form-control val-text" />
                                    </div>
                                    <div class="form-group">
                                        <textarea v-model="member.address" type="text"
                                                  placeholder="Enter address" class="form-control val-text">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <input v-model="member.telephone" type="text"
                                               placeholder="Enter telephone" class="form-control val-text" />
                                    </div>
                                    <div class="form-group">
                                        <input v-model="member.lc_number" type="number"
                                               placeholder="Enter Lc Number" class="form-control val-text" />
                                    </div>
                                    <div class="form-group">
                                        <label>0 is non active, 1 is active</label>
                                        <input v-model="member.is_active" type="number"
                                               placeholder="Enter Lc Number" class="form-control val-text" />
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                                            <strong>Save</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {member} from './../../js/setting/config'
    import moment from 'moment'
    export default {
        name: "Member",
        created() {
            this.getDataMember();
        },

        data() {
            return {
                member:{
                    id: '',
                    name: '',
                    age: '',
                    address: '',
                    telephone: '',
                    lc_number: '',
                    date_of_joined: moment(Date.now()).format('YYYY-MM-DD HH:mm'),
                    is_active: 1
                },
                members:[]
            }
        },

        methods: {
            async handleSubmit() {
                $("#memberModal").click()

                const postData = {
                    'id'            : this.member.id,
                    'name'          : this.member.name,
                    'age'           : this.member.age,
                    'address'       : this.member.address,
                    'telephone'     : this.member.telephone,
                    'lc_number'     : this.member.lc_number,
                    'date_of_joined': this.member.date_of_joined,
                    'is_active'     : this.member.is_active,
                };
                console.log(postData)
                try {
                    let response = await axios.post(member, postData);
                    swal({
                        title: "success!",
                        text: response.data.message,
                        type: "success"
                    });
                    this.getDataMember()
                }catch (err) {
                    await swal({
                        title: "Fail to save data!",
                        text: 'Please fill all form',
                        type: "error",
                        allowOutsideClick: false,
                    });
                    window.location = "/members";
                }
            },
            async getDataMember() {
                let response = await axios.get(member);
                this.members = response.data.data
            },

            async editForm(id) {
                let response = await axios.get(member + '/' + id);
                this.member = response.data.data;
                $("#memberModal").modal('show')
            },

            async deleteData(id, index) {
                let result = await swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                });
                console.log(result)
                if (result.value) {
                    try {
                        let response = await axios.delete(member + '/' + id)
                        await swal({
                            title: "success!",
                            text: response.data.message,
                            type: "success"
                        });
                        this.members.splice(index, 1);
                    }catch (err) {

                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>