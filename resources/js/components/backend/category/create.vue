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
                                <h3 class="float-left">Add Category</h3>
                                <p class="float-right">
                                    <router-link class="btn btn-info btn-sm" to="/categories"><i class="fa fa-plus-square"></i> Category List</router-link>
                                </p>
                            </div>

                            <div class="card-body">
                                <form @submit.prevent="addCategory()">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Category Name</label>
                                            <input type="text" id="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" v-model="form.name" placeholder="Enter Category Name">
                                            <has-error :form="form" field="name"></has-error>

                                        </div>

                                        <div class="form-group col-md-7">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" v-model="form.status" value="1">Active
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" v-model="form.status" value="0">Inactive
                                                </label>
                                            </div>
                                            <span :class="{ 'is-invalid': form.errors.has('status') }"></span>
                                            <has-error :form="form" field="status"></has-error>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <button :disabled="form.busy" type="submit" class="btn btn-primary">Submit</button>
                                        </div>

                                    </div>
                                </form>
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
        name: "create",
        data(){
            return{
                form : new Form({
                    'name' : '',
                    'status' : ''
                }),
            }
        },
        methods: {
            addCategory(){
                let test = this;
                this.form.post('add-category').then(function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Category Successfully Added'
                    });
                    // test.$router.push('/categories');
                    test.form.name = '';
                    test.form.status = '';
                }).catch(function () {

                });
            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
