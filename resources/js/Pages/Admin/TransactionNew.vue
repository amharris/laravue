<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Transaction
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <form @submit.prevent="processPayment">
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.props.flash.message">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ $page.props.flash.message }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="lg:w-3/4 w-full mx-auto mt-8 overflow-auto bg-teal-200 px-4 py-3 shadow-md my-3">
                        <p>Transaction for customer: ID <strong>{{ $page.props.customer.id }}</strong>, Name: <strong>{{ $page.props.customer.name }}</strong>, Email: <strong>{{ $page.props.customer.email }}</strong></p>
                    </div>
                    <div class="lg:w-3/4 w-full mx-auto mt-8 overflow-auto">
                    
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl">Item</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Quantity</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Price</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-show="!cartQuantity">
                                    <td colspan="4" class="p-5 text-blue-900 text-center">Add new item</td>
                                </tr>
                                <tr v-for="(item, index) in items" :key="item.id">
                                    <td class="p-4" v-text="item.name"></td>
                                    <td class="p-4" v-text="item.quantity"></td>
                                    <td class="p-4" v-text="cartLineTotal(item)"></td>
                                    <td class="w-10 text-right">
                                        <button
                                            class="flex ml-auto text-sm text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                                            @click.prevent="removeFromCart(index, item)"
                                        >Remove</button>
                                    </td>
                                </tr>
                                <tr class="border-t-2 border-gray-400">
                                    <td class="p-4 font-bold">Total Amount</td>
                                    <td class="p-4 font-bold" v-text="cartQuantity"></td>
                                    <td class="p-4 font-bold" v-text="getTotal()"></td>
                                    <td class="w-10 text-right">
                                        <button
                                            class="flex ml-auto text-sm text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                                            @click.prevent="addItem()"
                                        >Add Item</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="lg:w-3/4 w-full mx-auto mt-8">
                        <div class="p-2 w-full px-4 py-3 sm:px-6 sm:flex sm:flex-row">
                            <span class="text-blue-500 text-sm">Reward point earned: {{ $props.rewardpoint.point }} ({{ $props.rewardpoint.rule_name }})</span>
                            
                        </div>
                        <div class="p-2 w-full px-4 py-3 sm:px-6 sm:flex sm:flex-row">
                            <button
                                class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                                @click.prevent="processPayment()"
                                :disabled="paymentProcessing"
                                v-text="paymentProcessing ? 'Processing' : 'Save'"
                            ></button>
                        </div>
                    </div>
                    </form>
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
                                      <label for="itemName" class="block text-gray-700 text-sm font-bold mb-2">Item Name:</label>
                                      <Select2 id="itemName" :settings="settings" @select="getProduct($event)" v-model="item.id" />
                                  </div>
                                  <div class="mb-4">
                                      <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
                                      <input type="number" min="1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled" id="quantity" v-model="item.quantity">
                                  </div>
                                  <div class="mb-4">
                                      <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                                      <input type="text" :disabled="true" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled" id="price" v-model="item.price">
                                  </div>
                                  <div class="mb-4">
                                      <label for="subtotal" class="block text-gray-700 text-sm font-bold mb-2">Subtotal:</label>
                                      <input type="text" :disabled="true" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled" id="subtotal" v-model="subtotalItem">
                                  </div>
                            </div>
                          </div>
                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button @click="addNewRow(item)" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="createMode">
                                Add Item
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
</template>
<script>
    import BreezeAuthenticatedLayout from '@/Layouts/AdminAuthenticated'
    import Select2 from 'vue3-select2-component'
    import NProgress from 'nprogress'
    import { useForm } from '@inertiajs/inertia-vue3'
    import { InertiaProgress } from '@inertiajs/progress'

    InertiaProgress.init({delay: 250})
    
    export default {
        components: {
            BreezeAuthenticatedLayout,
            Select2,
        },
        props: ['data', 'errors', 'customer', 'cart', 'items', 'rewardpoint'],
        data() {
            return {
                createMode: false,
                isOpen: false,
                item: {
                    id: null,
                    name: null,
                    quantity: null,
                    price: null,
                    subtotal: null,
                },
                paymentProcessing: false,
                settings: {
                    minimumInputLength: 3,
                    width: 'element',
                    ajax: {
                        url: `/admin/searchItem`,
                        dataType: "json",
                        delay: 300,
                        data: function(params) {
                            return {
                                term: params.term,
                                page: 1
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.results.map( function({ id, name: text, price }) { 
                                    return {id, text, price};
                                }),
                                pagination: {
                                    more: false
                                }
                            };
                        }
                    }
                }
            }
        },
        setup () {
            const form = useForm({
                email: null,
                password: null,
                remember: false,
            });

            const reqIntercept = axios.interceptors.request.use(function(config) {
                NProgress.start();
                return config;
            }, function(error) {
                console.log('Error');
                return Promise.reject(error);
            });

            const resIntercept = axios.interceptors.response.use(function(response) {
                NProgress.done();
                return response;
            }, function(error) {
                console.log('Error fetching the data');
                return Promise.reject(error);
            });

            return { form, resIntercept, reqIntercept }
        },
        methods: {
            cartLineTotal(item) {
                let amount = item.price * item.quantity;

                return amount.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            },
            updateProducts(products) {
                this.$page.props.products = products;
            },
            closeModal() {
                this.isOpen = false;
                this.reset();
                this.createMode=false;
            },
            reset() {
                this.item = {
                    id: null,
                    name: null,
                    quantity: null,
                    price: null
                }
            },
            getProduct(event) {
                this.item.id = event.id,
                this.item.name = event.text;
                this.item.quantity = 1;
                this.item.price = event.price;
                this.item.subtotal = this.subtotalItem;
            },
            getTotal() {
                return this.cartTotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            },
            addItem() {
                this.isOpen = true;
                this.createMode=true;
            },
            addNewRow(item){
                var newItem = {
                    id: item.id,
                    name: item.name,
                    price: item.price,
                    quantity: parseInt(item.quantity),
                    subtotal: this.subtotalItem
                };

                if (this.saveRow(newItem)) {
                    this.$props.items.push(newItem);
                }

                this.closeModal();
            },
            removeFromCart(index, item) {
                return axios.delete('/admin/bags/'+this.cart.id, {data: item});
                this.$page.props.items.splice(index, 1);
            },
            async saveRow(item) {
                return axios.post('/admin/bags', {cart: this.cart.id, item: item})
                    .then(function(res){
                        return true;

                    }).catch(function(error){
                        return false;
                    });
            },
            updateCart(cart) {
                this.$page.props.items = cart;
            },
            processPayment() {

                var trx = {
                    customer: this.$page.props.customer,
                    cart: this.$page.props.items,
                    rewardpoint: this.$page.props.rewardpoint,
                    total: this.cartTotal
                }

                this.paymentProcessing = true;
                this.$inertia.post('/admin/transactions', trx);
            }

        },
        computed: {
            cartQuantity() {
                return this.$page.props.items.reduce((acc, item) => acc + item.quantity, 0);
            },
            cartTotal() {
                let amount = this.$page.props.items.reduce((acc, item) => acc + (item.price * item.quantity), 0);
                return amount;
            },
            subtotalItem() {
                return this.item.quantity * this.item.price;
            }
        }
    }
</script>

 