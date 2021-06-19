<template>
<div>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transaction Details
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
                    <button @click="back()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">&lt; Back</button>
                    
                    <h3 class="text-3xl text-blue-500 text-bold">Ref. ID: {{ data.reference_id }}</h3>
                    <div class="py-6 flex flex-col justify-center">
                        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
                            <div class="bg-gray-100 dark:bg-gray-800 duration-500 flex p-4">
                                <div class="flex flex-col justify-center">
                                    <p class="text-gray-900 dark:text-gray-300 font-bold">Recorded at</p>
                                    <p class="text-black dark:text-gray-100 text-justify">{{ formatDate(data.created_at) }}</p>
                                </div>
                            </div>

                            <div class="bg-gray-100 dark:bg-gray-800 duration-500 flex p-4">
                                <div class="flex flex-col justify-center">
                                    <p class="text-gray-900 dark:text-gray-300 font-bold">Status</p>
                                    <p class="text-black dark:text-gray-100 text-justify">{{ data.status }}</p>
                                </div>
                            </div>

                            <div class="bg-gray-100 dark:bg-gray-800 duration-500 flex p-4">
                                <div class="flex flex-col justify-center">
                                    <p class="text-gray-900 dark:text-gray-300 font-bold">Customer Name</p>
                                    <p class="text-black dark:text-gray-100 text-justify">{{ data.user.name }}</p>
                                </div>
                            </div>

                            <div class="bg-gray-100 dark:bg-gray-800 duration-500 flex p-4">
                                <div class="flex flex-col justify-center">
                                    <p class="text-gray-900 dark:text-gray-300 font-bold">Customer Email</p>
                                    <p class="text-black dark:text-gray-100 text-justify">{{ data.user.email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-3 py-2">Item Name</th>
                                <th class="px-3 py-2">Price</th>
                                <th class="px-3 py-2">Qty</th>
                                <th class="px-3 py-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, key) in data.detail" :key="key">
                                <td class="border px-3 py-2">{{ row.items.name }}</td>
                                <td class="border px-3 py-2">{{ row.items.price }}</td>
                                <td class="border px-3 py-2">{{ row.qty }}</td>
                                <td class="border px-3 py-2">{{ row.total_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</div>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/AdminAuthenticated'
    import moment from 'moment'
    import Select2 from 'vue3-select2-component'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            Select2,
        },
        props: ['data', 'errors'],
        data() {
            return {
                user: null,
                detail: null,
                status: null,
                total_payment: null,
                point: null
            }
        },
        methods: {
            back() {
                return this.$inertia.get('/admin/transactions');
            },
            formatDate(datetime) {
                moment.locale('id');
                return moment(datetime).format("dddd, D MMMM YYYY, HH:mm:ss");
            }
        }
    }
</script>