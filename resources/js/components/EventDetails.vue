<template>
    <div  class="p-5 mb-4 border border-gray-100 rounded-lg bg-gray-50 sticky  inset-x-0 top-0" v-show="showEvent">
        <h2 class="text-3xl">{{ event.name }}</h2>
        <p class="p-3">{{ event.description }}</p>


        <div class="text-2xl bold text-center">{{ formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}</div>
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                event: [],
                showEvent: false,
            }
        },
        created() {
            this.axios
                .get('http://localhost/api/get_event/')
                .then(response => {
                    this.event = response.data;
                    this.showEvent = true;
                });
        },

        

        methods: {

            // filterEvents: function(filter) {
            //     this.filter = filter
            // }
            formatDate(eventDate) {
                if(eventDate){
                    let date = new Date(eventDate);
                    console.log(date);
                    return new Intl.DateTimeFormat('en-US', {dateStyle: 'long'}).format(date);
                }
                return eventDate;
            },






    //         filteredOfficialScenarios() {
    //   return SCENARIOS
    //     .filter(s => new Date(s.created) >= START_DATE)
    //     .sort((a, b) => new Date(a.created) - new Date(b.created)
    //   );
    // },
            
        }
    }
</script>