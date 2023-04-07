<template>
    
    <div class="flex flex-col md:flex-row gap-6 relative">

        <div class="md:w-1/2"><EventDetails /></div>
        <div class="md:w-1/2"><EventSessions /></div>
    </div>









    


    
</template>

<script>
    import EventDetails from './components/EventDetails.vue'
    import EventSessions from './components/EventSessions.vue'
    
    export default {

        name: 'App',
        components: {
            EventDetails,
            EventSessions
        },
    }
</script>
