<script>

import axios from 'axios';
import { ref, onMounted, reactive, watch } from 'vue';
import {Form, Field } from 'vee-validate'
import moment from 'moment';
import { useToastr } from '../toastr';
import { debounce } from 'lodash';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

// const searchQuery = ref(null);
// const searchResults = ref({'': []});

// const search1 = () =>  {
       
//         axios.get('/api/search/', {
//         params: {

//             query:searchQuery.value
//         }
//     })

//         .then(response => {
//           searchResults.value = response.data;

//         })
//         .catch(error => {
//             console.log(error);
//         })

//     }

// export default {
//   data() {
//     return {
//       searchQuery: '',
//       searchResults: [],
//     };
//   },
//   methods: {
//     async search() {
//       try {
//         const response = await axios.get(`/api/search?q=${this.searchQuery}`);
//         this.searchResults = response.data;
//       } catch (error) {
//         console.log(error);
//       }
//     },
//   },
//   watch: {
//     searchQuery: function(newQuery, oldQuery) {
//       if (newQuery !== oldQuery && newQuery !== '') {
//         this.search();
//       } else {
//         this.searchResults = [];
//       }
//     },
//   },
// };

// export default {
//   data() {
//     return {
//       searchQuery: "",
//       isLoading: false,
//       searchResults: []
//     };
//   },
//   watch: {
//     searchQuery() {
//       this.search();
//     }
//   },
//   methods: {
//     async search() {
//       if (this.searchQuery.length < 3) {
//         this.searchResults = [];
//         return;
//       }

//       this.isLoading = true;
//       try {
//         const response = await fetch(`/api/search?query=${this.searchQuery}`);
//         const data = await response.json();
//         this.searchResults = data;
//       } catch (error) {
//         console.log(error);
//       }
//       this.isLoading = false;
//     }
//   }
// };

// export default {
//   data() {
//     return {
//       query: '',
//       customers: []
//     };
//   },
//   watch: {
//     query: function(newQuery, oldQuery) {
//       if (newQuery.length < 2) {
//         this.customers = [];
//         this.tickets = [];
//         this.payments = [];
//         return;
//       }

//       axios.get(`/api/search?query=${newQuery}`)
//         .then(response => {
//           this.customers = response.data.customers;
//         //   this.tickets = response.data.tickets;
//         //   this.payments = response.data.payments;
//         })
//         .catch(error => {
//           console.log(error);
//         });
//     }
//   }
// };

// Best one yet
export default {
  data() {
    return {
      searchQuery: '',
      searchResults: [],
    }
  },
  methods: {
    search() {
      axios.get(`/api/search?q=${this.searchQuery}`)
        .then(response => {
          this.searchResults = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
}

</script>




<template>
   
   <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
    <h1 class="m-0">Dashboard</h1>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    </div>
    </div>
    </div>
    </div>


    <div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between">
                <h4 class="">
                    Welcome!
                </h4>
                <div class="mb-2">
                    <input v-model="searchQuery" @input="search"  type="text" placeholder="Search..." class="form-control"/> 
                    <!-- <button @click.prevent="search">Search</button> -->
                </div>
         </div>

         <div class="card ">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Customers</th>
                                <th>Tickets</th>
                                <th>Payments</th>
                                
                            </tr>
                        </thead>
                            <!-- <tbody v-if="searchResults.length > 0">
                                <tr v-for="(result, index) in searchResults" :key="index">
                                    <td>{{ result.customer.first_name }} {{ result.customer.last_name }}</td>
                                    <td>{{ result.ticket.title }}</td>
                                    <td>{{ result.payment.transaction_code }}</td>
                                </tr>
                        </tbody> -->
                        <tbody>
                            <!-- <tr v-for="result in searchResults" :key="result.id">
                            <td> {{ index +1 }}</td>
                            <td>{{ result.customer.first_name }} {{ result.customer.last_name }}</td>
                            <td>{{ result.ticket.title }}</td>
                            <td>{{ result.payment.transaction_code }}</td>
                            </tr>
                            <tr v-if="searchResults.length === 0">
                            <td colspan="6" class="text-center">No results found</td>
                            </tr> -->

                            <!-- <tr v-for="customer in customers" :key="customer.id">

                                <td>{{ customer.first_name }} {{ customer.last_name }}</td>
                                <td>{{ customer.created_at }}</td>
                                <td>{{ customer.username }}</td>
                            </tr> -->
                            
                            <!-- Best one yet -->
                            <!-- <tr v-for="(result,index) in searchResults" :key="result.id">
                                <td>{{ index +1 }}</td>
                                <td>{{ result.first_name }}
                                {{ result.last_name }} {{ result.customer_first_name }} {{ result.customer_last_name }} </td>
                                <td>{{ result.ticket_title }} {{ result.title }}</td>
                                <td>{{ result.transaction_code }} </td>
                            </tr> -->
                            
                            <tr v-for="(result, index) in searchResults" :key="index">
                                <td>{{ index +1 }}</td>
                                <td>{{ result.customer_first_name }} {{ result.customer_last_name }}</td>
                                <td>{{ result.title }}</td>
                                <td>{{ result.transaction_code }}</td>
                            </tr>
                        </tbody>
                        <!-- <tbody v-else>
                            <tr>
                                <td colspan="6" class="text-center" class="text-center">No results found...</td>
                            </tr>
                        </tbody> -->
                    </table>
                        <!-- <Bootstrap4Pagination
                            :data="users"
                            @pagination-change-page="getUsers"
                        /> -->
                </div>
            </div>
    </div>
    </div>

</template>