<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-purple-100 m-4 my-3 px-4 py-3 rounded-b shadow-md text-red-600" role="alert" v-if="$page.props.flash.message">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ $page.props.flash.message }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="bg-purple-100 m-4 my-3 px-4 py-3 rounded-b shadow-md text-red-600" role="alert" v-if="$page.props.errors.length > 0 ">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ $page.props.errors[0] }}</p>
                        </div>
                      </div>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">
                        Welcome, {{ data.name }}!
                    </div>

                    <point class="p-6" :points="data.points" />

                    <reward :rewards="rewards" :redeems="redeems" :user="data.id" />
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import Point from '@/Pages/User/Point'
    import Reward from '@/Pages/User/Reward'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            Point,
            Reward,
        },
        props: ['data', 'rewards', 'redeems'],
        data() {
            return {
                componentKey: 0
            }
        }
    }
</script>
