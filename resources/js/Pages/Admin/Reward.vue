<template>
<div>
    <breeze-authenticated-layout v-bind:form="form" v-bind:data="data">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Rewards
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
                    <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Add New Reward</button>
                    <button @click="openRedeemModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-3 mx-3">Redeem Reward</button>
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-3 py-2 w-20">ID</th>
                                <th class="px-3 py-2">Name</th>
                                <th class="px-3 py-2">Min. Points to Redeem</th>
                                <th class="px-3 py-2">Redeemed Count</th>
                                <th class="px-3 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, key) in data" :key="key">
                                <td class="border px-3 py-2">{{ row.id }}</td>
                                <td class="border px-3 py-2">{{ row.name }}</td>
                                <td class="border px-3 py-2">{{ row.point_min }}</td>
                                <td class="border px-3 py-2">{{ row.redeems_count }}</td>
                                <td class="border px-3 py-2">
                                    <button @click="edit(row)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <button @click="deleteRow(row)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
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
                                      <label for="rewardName" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="rewardName" placeholder="Enter Name" v-model="form.name">
                                      <div v-if="$page.props.errors.name" class="text-red-500">{{ $page.props.errors.name[0] }}</div>
                                  </div>
                                  <div class="mb-4">
                                      <label for="pointMin" class="block text-gray-700 text-sm font-bold mb-2">Min Point:</label>
                                      <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pointMin" placeholder="Enter value" v-model="form.point_min">
                                      <div v-if="$page.props.errors.point_min" class="text-red-500">{{ $page.props.errors.point_min[0] }}</div>
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

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isRedeemOpen || $page.props.errors.redeemname">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                          <form>
                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="gap-3 grid grid-cols-1 md:grid-cols-2">
                                  <div class="mb-4">
                                      <label for="redeemName" class="block text-gray-700 text-sm font-bold mb-2">Customer Name:</label>
                                      <!-- <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="redeemName" placeholder="Enter Name" v-model="redeem.name"> -->
                                      <Select2 id="redeemName" @select="selectedUser($event)" :options="settings.data" :settings="settings" v-model="redeem.user_id" />
                                      <div class="mt-2 text-sm text-green-500">Points earned: {{redeem.user_points}}</div>
                                      <div v-if="$page.props.errors.redeemname" class="text-red-500">{{ $page.props.errors.redeemname[0] }}</div>
                                  </div>
                                  <div class="mb-4">
                                      <label for="redeemReward" class="block text-gray-700 text-sm font-bold mb-2">Choose Available Reward:</label>
                                      <!-- <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="redeemReward" placeholder="Enter value" v-model="redeem.reward"> -->
                                      <select v-model="redeem.reward_id" id="redeemReward">  
                                        <option v-for="(opt, index) in rewardoptions" :key="index" :value="opt.id">{{ opt.name }} (min. points {{opt.point_min}})</option>
                                      </select>
                                      <div v-if="$page.props.errors.redeemreward" class="text-red-500">{{ $page.props.errors.redeemreward[0] }}</div>
                                  </div>
                            </div>
                          </div>
                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" @click="submitRedeem(redeem)">
                                Redeem
                              </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                              <button @click="closeRedeemModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
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
                editMode: false,
                isOpen: false,
                isRedeemOpen: false,
                form: {
                    name: null,
                    point_min: null
                },
                redeem: {
                    user_id: null,
                    reward_id: null,
                    user_points: null
                },
                rewardoptions: this.data,
                settings: {
                    width: 'element',
                    data: this.customers.map(function({id, name: text, points}) {
                        return { id, text, points};
                    })
                }
            }
        },
        methods: {
            openModal() {
                this.isOpen = true;
            },
            openRedeemModal(){
                this.isRedeemOpen = true;
            },
            closeModal() {
                this.isOpen = false;
                // this.reset();
                this.editMode=false;
            },
            closeRedeemModal() {
                this.isRedeemOpen = false;
            },
            reset() {
                this.form = {
                    name: null,
                    point_min: null
                }
            },
            selectedUser(event) {
                this.redeem.user_points = event.points;

                this.rewardoptions = this.data.filter(function(option){
                    return option.point_min <= event.points;
                })
            },
            submitRedeem(data) {
                // console.log(data);
                this.$inertia.post('/admin/rewards/redeem', data);
                this.closeRedeemModal();
            },
            save(data) {
                this.$inertia.post('/admin/rewards', data)
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
                this.$inertia.post('/admin/rewards/' + data.id, data)
                this.reset();
                this.closeModal();
            },
            deleteRow(data) {
                if (!confirm('Are you sure want to remove?')) return;
                data._method = 'DELETE';
                this.$inertia.post('/admin/rewards/' + data.id, data)
                this.reset();
                this.closeModal();
            },
        },
    }
</script>
 