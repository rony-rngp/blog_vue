<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-10 offset-1">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="float-left">Category List</h3>
                                <p class="float-right">
                                    <router-link class="btn btn-info btn-sm" to="add-category"><i class="fa fa-plus-square"></i> Add Category</router-link>
                                </p>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(category, key) in getCategories">
                                            <td>{{ key+1 }}</td>
                                            <td>{{ category.name }}</td>
                                            <td>{{ category.slug }}</td>
                                            <td><span class="badge" :class=" statusColor(category.status)">{{ statusName(category.status) }}</span></td>
                                            <td>{{ category.created_at | time }}</td>
                                            <td>
                                                <router-link :to="'/edit-category/'+category.id" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></router-link>
                                                <button type="button" @click="removeCategory(category.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        <tr v-if="emptyData()">
                                            <td colspan="6" class="text-center">
                                                <h5 class="text-danger">Data not found</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>


    export default {
        name: "manage",

        mounted() {
            this.$store.dispatch("getCategories");
        },

        computed : {
            getCategories(){
                return this.$store.getters.categories;
            }
        },

        methods: {
            statusName(status){
                let data = {
                    0 : 'Inactive', 1 : "Active",
                };

                return data[status];
            },
            statusColor(status){
                let data = {
                    0 : 'badge-danger', 1 : "badge-success",
                };
                return data[status];
            },

            removeCategory(id){
                let test = this;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get('destroy/category/'+id).then(function (response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            test.$store.dispatch("getCategories");
                        }).catch(function () {

                        });

                    }
                });
            },

            emptyData(){
                return this.getCategories.length < 1;
            },
        },



    }
</script>

<style scoped>

</style>
