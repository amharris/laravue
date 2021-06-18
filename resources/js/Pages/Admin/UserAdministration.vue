<template>
<div>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User List
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
                    <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Add New User</button>
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-3 py-2 w-20">ID</th>
                                <th class="px-3 py-2">Name</th>
                                <th class="px-3 py-2">Email</th>
                                <th class="px-3 py-2">Points</th>
                                <th class="px-3 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, key) in data.data" :key="key">
                                <td class="border px-3 py-2">{{ row.id }}</td>
                                <td class="border px-3 py-2">{{ row.name }}</td>
                                <td class="border px-3 py-2">{{ row.email }}</td>
                                <td class="border px-3 py-2">{{ row.points }}</td>
                                <td class="border px-3 py-2">
                                    <button @click="edit(row)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <button @click="deleteRow(row)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination class="mt-6" :links="data.links" />

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
                                      <label for="userName" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="userName" placeholder="Enter Name" v-model="form.name">
                                      <div v-if="$page.props.errors.name" class="text-red-500">{{ $page.props.errors.name[0] }}</div>
                                  </div>
                                  <div class="mb-4">
                                      <label for="userEmail" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                      <input type="email" :disabled="editMode" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="userEmail" placeholder="Enter Email" v-model="form.email">
                                      <div v-show="editMode" class="text">Email cannot be changed</div>
                                      <div v-if="$page.props.errors.email" class="text-red-500">{{ $page.props.errors.email[0] }}</div>
                                  </div>
                                  <div class="mb-4">
                                      <label for="userPassword" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                                      <input type="password" :disabled="editMode" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="userPassword" v-model="form.password">
                                      <div v-show="editMode" class="text">Password cannot be changed</div>
                                      <div v-if="$page.props.errors.password" class="text-red-500">{{ $page.props.errors.password[0] }}</div>
                                  </div>
                                  <div class="mb-4" v-show="editMode">
                                      <label for="userPoints" class="block text-gray-700 text-sm font-bold mb-2">Points:</label>
                                      <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="userPoints" v-model="form.points">
                                      <div v-if="$page.props.errors.points" class="text-red-500">{{ $page.props.errors.points[0] }}</div>
                                  </div>
                            </div>
                          </div>
                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editMode" @click="save(form)">
                                Save
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
    import Pagination from '@/Components/Pagination'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            Pagination
        },
        props: ['data', 'errors'],
        data() {
            return {
                editMode: false,
                isOpen: false,
                form: {
                    name: null,
                    email: null,
                    password: null
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
                this.editMode=false;
            },
            reset() {
                this.form = {
                    name: null,
                    email: null,
                    password: null,
                }
            },
            save(data) {
                this.$inertia.post('/admin/users', data)
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
                this.$inertia.post('/admin/users/' + data.id, data)
                this.reset();
                this.closeModal();
            },
            deleteRow(data) {
                if (!confirm('Are you sure want to remove?')) return;
                data._method = 'DELETE';
                this.$inertia.post('/admin/users/' + data.id, data)
                this.reset();
                this.closeModal();
            },
        },
    }
</script>
 