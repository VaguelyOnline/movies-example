<template>
    <div>
        You are playing the game on {{ difficulty.title }} mode
    </div>
</template>

<script>
export default {
    name: "HigherLowerGame",
    props: {
        difficulty: {
            required: true,
            type: Object
        }
    }
}
</script>

<style scoped>

</style>
