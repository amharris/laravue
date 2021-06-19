<template>
    <div v-if="rewards.length > 0" class="p-6">
        <p class="text-lg">Redeem your points to get reward!</p>
        <p>Available reward for you:</p>
        <ul class="py-3">
            <li class="flex flex-wrap content-center hover:bg-gray-100 p-3" v-for="reward in rewards" :key="reward.id">
                <span class="bg-green-200 p-2 rounded-2xl text-5xl text-center w-1/12">{{ reward.point_min }}</span>
                <span class="text-2xl p-4 text-green-700"> {{ reward.name }}</span>
                <span class="p-5">Need {{ reward.point_min }} point</span>
                <a href="#" @click.prevent="redeem(reward.id)" class="bg-blue-400 text-white text-lg p-4 rounded hover:bg-blue-600">Get it now!</a>
            </li>
        </ul>
    </div>
    <div v-if="redeems.length > 0" class="p-6">
        <p class="text-lg">Your redeems:</p>
        <ul class="py-3">
            <li class="flex flex-wrap content-center bg-green-100 hover:bg-green-200 p-3" v-for="redeem in redeems" :key="redeem.id">
                <span class="text-2xl p-4 text-green-700"> {{ redeem.reward.name }}</span>
                <span class="p-5">Redeemed for {{ redeem.reward.point_min }} point</span>
                <span class="p-5">@ {{ formatDate(redeem.created_at) }}</span>
            </li>
        </ul>
    </div>
</template>

<script>
import moment from 'moment'

export default {
    props: ['rewards', 'redeems', 'user'],
    methods: {
        redeem(id) {
            if (!confirm('You will exchange your points with this reward. Are you sure?')) return;
            this.$inertia.post('/redeem/' + id, {user: this.user});
        },
        formatDate(datetime) {
            moment.locale('id');
            return moment(datetime).format("dddd, D MMMM YYYY, h:mm:ss");
        }
    }
}
</script>