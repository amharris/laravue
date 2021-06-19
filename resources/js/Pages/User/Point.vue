<template>
<div>
    <p class="text-2xl text-green-500" v-if="points">You have {{ points }} points</p>
    <p class="text-2xl text-gray-500" v-else>You don't have point yet</p>
</div>
</template>

<script>
export default {
    props: ['points']
}
</script>