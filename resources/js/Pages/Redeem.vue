<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Redeem Reward
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p class="text-lg">Congratulations {{ user.name }}!</p>
                        <p>You've got your reward:</p>
                        <p class="text-2xl p-4 text-green-700"> {{ data.name }}</p>
                        <p class="p-3">You exchange <span class="text-lg">{{ data.point_min }}</span> points for it</p>
                            
                        <p class="p-3">Your remaining points: <span class="text-lg">{{ user.points }}</span></p>
                    </div>

                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

    export default {
        components: {
            BreezeAuthenticatedLayout,
        },
        props: ['data', 'user']
    }
</script>
