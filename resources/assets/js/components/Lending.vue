<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Lending Movie List</h2>
                <h3>
                    <button class="btn btn-success" data-toggle="modal" data-target="#landingModal">Lending Movie Create
                    </button>
                </h3>

            </div>
            <div class="box-body">
                <table id="memberTables" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Movie</th>
                        <th>Member Name</th>
                        <th>Lending Date</th>
                        <th>Return Date</th>
                        <th>Lateness Charge</th>
                        <th>Confirm Return</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(lending, index) in lendings">
                        <td>{{lending.movie}}</td>
                        <td>{{lending.member}}</td>
                        <td><span class="label label-info">{{lending.lending_date}}</span></td>
                        <td><span class="label label-primary">{{lending.return_date}}</span></td>
                        <td>{{lending.lateness_charge}}</td>
                        <td>
                            <button v-show="lending.return_date === null " class="btn btn-warning" @click="confirmReturn(lending.id)">Confirm</button>
                            <button disabled v-show="lending.return_date !== null " class="btn btn-warning" @click="confirmReturn(lending.id)">Confirm</button>

                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="landingModal" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 b-r">
                                <form role="form" v-on:submit.once.prevent="handleSubmit()">
                                    <div class="form-group">
                                        <label>Movie</label>
                                        <select class="form-control" v-model="movieSelect">
                                            <option v-for="movie in movies" :value="movie.id">
                                                {{movie.title}}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Member</label>
                                        <select class="form-control" v-model="memberSelect">
                                            <option v-for="member in members" :value="member.id">
                                                {{member.name}}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Lending Date</label>
                                        <input v-model="lending.lending_date" type="date"
                                               class="form-control val-text" />
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

        <div id="landingConfirm" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 b-r">
                                <form role="form" v-on:submit.once.prevent="handleSubmitConfirm()">
                                    <input v-model="lending.id" type="hidden"
                                           class="form-control val-text"/>
                                    <div class="form-group">
                                        <label>Member Name</label>
                                        <input v-model="lending.memberName" type="text"
                                               class="form-control val-text" disabled />
                                    </div>
                                    <div class="form-group">
                                        <label>Movie</label>
                                        <input v-model="lending.movieName" type="text"
                                               class="form-control val-text" disabled />
                                    </div>
                                    <div class="form-group">
                                        <label>Lending Date</label>
                                        <input v-model="lending.lending_date" type="text"
                                               class="form-control val-text" disabled />
                                    </div>

                                    <div class="form-group">
                                        <label>Return Date Date</label>
                                        <input v-model="lending.return_date" type="date"
                                               class="form-control val-text" />
                                    </div>
                                    <div class="form-group">
                                        <label>Lateness charge</label>
                                        <input v-model="lending.lateness_charge" type="number"
                                               class="form-control val-text" />
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
    import {lending, movies, memberActive} from './../../js/setting/config'

    export default {
        name: "Lending",

        created() {
            this.getDataLending();
            this.movieList();
            this.memberActiveList();
        },

        data() {
            return {
                movieSelect: '',
                memberSelect:'',
                lending: {
                    lending_date: '',
                    return_date: '',
                    lateness_charge: '',
                    memberName: '',
                    movieName: '',
                    id: ''
                },
                movies: [],
                lendings: [],
                members: [],
            }
        },


        methods: {
            async getDataLending() {
                let response = await axios.get(lending);
                this.lendings = response.data.data
            },
            async movieList() {
                let response = await axios.get(movies);
                this.movies = response.data.data
            },
            async memberActiveList() {
                let response = await axios.get(memberActive);
                this.members = response.data.data
            },
            async confirmReturn(id) {
                let response = await axios.get(lending + '/' + id);
                this.lending.movieName = response.data.data.movie;
                this.lending.memberName = response.data.data.member;
                this.lending.lending_date = response.data.data.lending_date;
                this.lending.id = response.data.data.id;
                this.lending.lateness_charge = response.data.data.lateness_charge;
                this.lending.return_date = response.data.data.return_date;

                $("#landingConfirm").modal('show')
            },
            async handleSubmit() {
                $("#landingModal").click()

                const postData = {
                    'movie_id'          : this.movieSelect,
                    'member_id'         : this.memberSelect,
                    'lending_date'      : this.lending.lending_date,
                };

                if (this.movieSelect === '' && this.memberSelect === '' && this.lending.lending_date === '') {
                    await swal({
                                title: "Fail to save data!",
                                text: 'Please fill all form',
                                type: "error",
                                allowOutsideClick: false,
                            });
                            window.location = "/";
                }else {
                    try {
                        let response = await axios.post(lending, postData);
                        swal({
                            title: "success!",
                            text: response.data.message,
                            type: "success"
                        });
                        this.getDataLending()
                    }catch (err) {
                        await swal({
                            title: "Fail to save data!",
                            text: 'Please fill all form',
                            type: "error",
                            allowOutsideClick: false,
                        });
                        window.location = "/";
                    }
                }
            },
            async handleSubmitConfirm() {
                $("#landingConfirm").click()

                const postData = {
                    'id'                   : this.lending.id,
                    'return_date'          : this.lending.return_date,
                    'lateness_charge'      : this.lending.lateness_charge,
                };

                if (this.lending.return_date === '') {
                    await swal({
                        title: "Fail to save data!",
                        text: 'Please fill all form',
                        type: "error",
                        allowOutsideClick: false,
                    });
                    window.location = "/";
                }else {
                    let response = await axios.post(lending, postData);
                    swal({
                        title: "success!",
                        text: response.data.message,
                        type: "success"
                    });
                    this.getDataLending()
                }

            }
        }
    }
</script>

<style scoped>

</style>