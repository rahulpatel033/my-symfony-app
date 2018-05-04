<template>
   <div>
        <p>{{message}}</p>
        <button @click="reverseMessage">Reverse Message</button>
   </div>
</template>

<script>
   export default {
        name: "example",
        data: function () {
            return {
                message: 'Hello Vue!'
            }
        },
        methods: {
            reverseMessage: function () {
                this.message = this.message.split('').reverse().join('')
            }
        }
   }
</script>

<style scoped>

</style>