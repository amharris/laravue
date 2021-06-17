<template>
<div>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transaction
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.props.flash.message">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ $page.props.flash.message }}</p>
                        </div>
                      </div>
                    </div>
                    <button @click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">New Transaction</button>
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-3 py-2">Reference ID</th>
                                <th class="px-3 py-2">Customer Name</th>
                                <th class="px-3 py-2">Total Payment</th>
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Point</th>
                                <th class="px-3 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, key) in data" :key="key">
                                <td class="border px-3 py-2">{{ row.reference_id }}</td>
                                <td class="border px-3 py-2">{{ row.user.name }}</td>
                                <td class="border px-3 py-2">{{ currency(row.total_payment) }}</td>
                                <td class="border px-3 py-2">{{ row.status }}</td>
                                <td class="border px-3 py-2">{{ row.point.point }}</td>
                                <td class="border px-3 py-2">
                                    <button @click="edit(row)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <button @click="detail(row)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                          <form>
                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                  <div class="mb-4">
                                      <label for="custName" class="block text-gray-700 text-sm font-bold mb-2">Customer Name:</label>
                                      <Select2 :disabled="editMode" :options="$page.props.customers" id="custName" :settings="{width: 'element'}" v-model="form.user_id" />
                                  </div>
                                  <div class="mb-4" v-show="editMode">
                                      <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled" id="status" v-model="form.status">
                                      <div v-if="$page.props.errors.status" class="text-red-500">{{ $page.props.errors.status[0] }}</div>
                                  </div>
                                  <div class="mb-4" v-show="editMode">
                                      <label for="trxId" class="block text-gray-700 text-sm font-bold mb-2">Transaction ID:</label>
                                      <input type="text" :disabled="editMode" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled" id="trxId" v-model="form.reference_id">
                                  </div>
                                  <div class="mb-4" v-show="editMode">
                                      <label for="totalPayment" class="block text-gray-700 text-sm font-bold mb-2">Total Paid:</label>
                                      <input type="text" :disabled="editMode" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled" id="totalPayment" v-model="form.total_payment">
                                  </div>
                            
                            </div>
                          </div>
                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="createMode" @click="proceed(form)">
                                Create
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="editMode" @click="update(form)">
                                Update
                              </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                              <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancel
                              </button>
                            </span>
                          </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
       
    </breeze-authenticated-layout>
</div>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/AdminAuthenticated'

    import Select2 from 'vue3-select2-component'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            Select2,
        },
        props: ['data', 'errors', 'customers'],
        data() {
            return {
                createMode: false,
                editMode: false,
                isOpen: false,
                form: {
                    reference_id: null,
                    status: null,
                    total_payment: null,
                    user_id: null
                },
            }
        },
        methods: {
            openModal() {
                this.isOpen = true;
            },
            closeModal() {
                this.isOpen = false;
                this.reset();
                this.createMode=false;
                this.editMode=false;
            },
            reset() {
                this.form = {
                    reference_id: null,
                    status: null,
                    total_payment: null,
                    user_id: null
                }
            },
            save(data) {
                this.$inertia.post('/admin/transactions', data)
                this.reset();
                this.closeModal();
                this.editMode = false;
            },
            edit(data) {
                this.form = Object.assign({}, data);
                this.editMode = true;
                this.openModal();
            },
            update(data) {
                data._method = 'PATCH';
                this.$inertia.post('/admin/transactions/' + data.id, data)
                this.reset();
                this.closeModal();
            },
            detail(data) {
                this.$inertia.get('/admin/transactions/' + data.id)
                // this.reset();
                this.closeModal();
            },
            create(){
                this.openModal();
                this.createMode = true;
                // this.form = Object.assign({}, data);
            },
            proceed(data) {
                // console.log(data);
                this.createMode = false;
                this.$inertia.post('/admin/transactions/create', data, { preserveState: false });
                this.closeModal();
            },
            currency(dec){
                return parseFloat(dec).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            }
        },
    }
</script>
 