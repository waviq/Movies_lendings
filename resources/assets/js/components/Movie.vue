<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Movie list</h2>
                <h3><button class="btn btn-success" data-toggle="modal" data-target="#movieModal">Create</button></h3>

            </div>
            <div class="box-body">
                <table id="moviesTables" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Release Date</th>
                        <th>Created At</th>
                        <th>Edit</th>
                        <th>Delete</th>


                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(movie, index) in movies">
                        <td>{{movie.title}}</td>
                        <td>{{movie.genre}}</td>
                        <td>{{movie.release_date}}</td>
                        <td>{{movie.created_at}}</td>
                        <td><button class="btn btn-info" @click="editForm(movie.id)">Edit</button></td>
                        <td><button class="btn btn-danger" @click="deleteData(movie.id, index)">Delete</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="movieModal" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 b-r">
                                <form role="form" v-on:submit.once.prevent="handleSubmit()">
                                    <!--<div class="form-group">-->
                                        <!--<label>Subscriber</label>-->
                                        <!--<select class="form-control" name="category" v-model="category">-->
                                            <!--<option v-for="category in categories" :value="category.id" name="category">{{category.name}}</option>-->
                                        <!--</select>-->
                                    <!--</div>-->
                                    <input v-model="movie.id" type="hidden"
                                           class="form-control val-text"/>
                                    <div class="form-group">
                                        <input v-model="movie.title" type="text"
                                                  placeholder="Enter title" class="form-control val-text"/>
                                    </div>
                                    <div class="form-group">
                                        <input v-model="movie.genre" type="text"
                                               placeholder="Enter genre" class="form-control val-text" />
                                    </div>
                                    <div class="form-group">
                                        <label>Release date</label>
                                        <input v-model="movie.release_date" type="date"
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
    import {movies} from './../../js/setting/config'
    export default {
        name: "Movie",
        created() {
            this.getDataMovie();
        },

        data() {
            return {
                movie:{
                    id: '',
                    title: '',
                    genre: '',
                    release_date: '',
                },
                movies:[]
            }
        },

        methods: {
            async handleSubmit() {
                $("#movieModal").click()

                const postData = {
                    'id'            : this.movie.id,
                    'title'         : this.movie.title,
                    'genre'         : this.movie.genre,
                    'release_date'  : this.movie.release_date
                };

                try {
                    let response = await axios.post(movies, postData);
                    swal({
                        title: "success!",
                        text: response.data.message,
                        type: "success"
                    });
                    this.getDataMovie()
                }catch (err) {
                    await swal({
                        title: "Fail to save data!",
                        text: 'Please fill all form',
                        type: "error",
                        allowOutsideClick: false,
                    });
                    window.location = "/movies";
                }
            },
            async getDataMovie() {
                let movie = await axios.get(movies);
                this.movies = movie.data.data
            },

            async editForm(id) {
                let movie = await axios.get(movies + '/' + id);
                this.movie = movie.data.data;
                $("#movieModal").modal('show')
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


                        let response = await axios.delete(movies + '/' + id)
                        await swal({
                            title: "success!",
                            text: response.data.message,
                            type: "success"
                        });
                        this.movies.splice(index, 1);
                    }catch (err) {

                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>