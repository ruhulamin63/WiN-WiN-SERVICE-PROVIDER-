<template>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">PRACTICAL SKILL TEST</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#l">Dashboard</a></li>
                            <li class="breadcrumb-item active">Area with code</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <form ref="form" @submit.prevent="create">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr style="margin-top:20px;"></tr>
                                    <tr>
                                        <th>Code</th>
                                        <th>Full Name</th>
                                        <th>Age</th>
                                        <th>Location</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        Add New Customer
                                        <hr>
                                    </tr>
                                    <tr v-for="(item, index) in customers" :key="index">
                                        <td>
                                            <input type="number" class="form-control" v-model="item.code" placeholder="Enter Code" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" v-model="item.full_name" placeholder="Enter Full Name" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" v-model="item.age" placeholder="Enter Age" />
                                        </td>
                                        <td>
                                            <select class="form-control" v-model="item.location" @change="selectArea">
                                                <option v-for="location in areas" :key="location.id" v-bind:value="location.id">
                                                    {{ location.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <a class="mr-2 text-danger" href="javascript:"
                                                v-if="index != 0"
                                                @click="remove(index)">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                            <a class="mr-4" href="javascript:"
                                                v-if="index == customers.length - 1" 
                                                @click="add(index)">
                                                <i class="fa fa-plus-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
</template>

<script>    
    export default {
        name: "HomePage",

        data() {
            return {
                customers: [
                    {
                        code: '',
                        full_name: '',
                        age: '',
                        location: ''
                    }
                ],
                areas:[],
                selectedLocation: '',
            };
        },

        methods: {
            add(index) {
                this.customers.push({
                    code: '',
                    full_name: '',
                    age: '',
                    location: ''
                });
            },

            remove(index) {
                this.customers.splice(index, 1);
            },

            async getCustomers() {
                try {
                    const response = await axios.get('/api/areas');
                    this.areas = response.data;
                } catch (error) {
                    console.log(error);
                }
            },

            async selectArea() {
                try {
                    const singleArea = this.customers.map(customer => {
                        return this.areas.find(area => area.id == customer.location);
                    });

                    const area = singleArea[singleArea.length - 1];                    
                    const code = area.code;
                    const id = area.id;

                    const lastCode = code.substr(code.length - 3);
                    const newCode = parseInt(lastCode) + id;
                    const newCodeLength = newCode.toString().length;
                    const newCodeZero = '0'.repeat(3 - newCodeLength);
                    const newCodeString = code.substr(0, code.length - 3) + newCodeZero + newCode;
                    const finalCode = code+newCodeString;

                    this.customers[this.customers.length - 1].code = finalCode;

                } catch (error) {
                    console.log(error);
                }
            },

            async create() {
                try {            
                    this.customers.forEach(customer => {
                        customer.location = parseInt(customer.location);
                    });    
                    const response = await axios.post('/api/customers', this.customers);
                    this.$refs.form.reset();
                    this.customers = [
                        {
                            code: '',
                            full_name: '',
                            age: '',
                            location: ''
                        }
                    ];
                } catch (error) {
                    console.log(error);
                }
            }
        },
        
        mounted() {
            this.getCustomers();
        }
    }
</script>