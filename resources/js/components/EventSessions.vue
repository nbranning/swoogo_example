<template>
    <div v-show="showSessions">
        <button class="mb-6 border rounded border-[#726bea] text-[#726bea] py-1 px-3" @click="toggleSort()">
            <span v-if="!sortDate">Sort Date End to Start</span>
            <span v-else>Sort Date Start to End</span>
        </button>
    



        <!-- loop through sessions -->
        <div class="p-5 mb-4 border border-gray-100 rounded-lg bg-gray-50 " v-for="session in event_sessions" :key="session.id" v-cloak>

            <div class="flex gap-3">
                <div class="shrink">
                    <div class="min-w-32 bg-white min-h-48 font-medium">
                        <div class="w-32 flex-none rounded-t lg:rounded-t-none lg:rounded-l text-center shadow-lg ">
                            <div class="block rounded-t overflow-hidden  text-center ">
                                <div class="bg-[#E9ECFF] py-1">{{ getEventMonth(session.date) }}</div>
                                <div class="pt-1 border-l border-r border-white bg-white">
                                    <span class="text-2xl font-bold leading-tight">{{ getEventDay(session.date) }}</span>
                                </div>
                                <div class="border-l border-r border-b rounded-b-lg text-center border-white bg-white -pt-2 -mb-1">
                                    <span class="text-sm">
                                        {{ getEventWeekDay(session.date) }}
                                    </span>
                                </div>
                                <div class="pb-2 border-l border-r border-b rounded-b-lg text-center border-white bg-white">
                                <span class="text-xs leading-normal">
                                    {{ formatTime(session.start_time) }} - {{ formatTime(session.end_time) }}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grow flex">
                    <div class="self-center"><h3 class="text-2xl">{{ session.name }}</h3></div>
                    
                </div>

            </div>
            <div class="flex justify-center">
                <button class="border rounded border-[#726bea] text-[#726bea] py-1 px-3" @click="showDetails('session-'+session.id)">Show Details</button>
            </div>
            <div :id="'session-'+session.id" class="hidden">
                <p>{{ session.description }}</p>
                <ol class="mt-3 divide-y divider-gray-200 ">
                    <!-- loop through speakers -->
                    <h4 class="text-xl">Speakers</h4>
                    <li v-for="speaker in session.speakers" :key="speaker.id">
                        <div class="block p-3 sm:flex hover:bg-gray-100 ">
                            <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0" :src="speaker.profile_picture" :alt="speaker.first_name + speaker.last_name"/>
                            <div class="text-gray-600 ">
                                <div class="text-base font-normal">
                                    <span class="font-medium text-gray-900 ">{{ speaker.first_name + speaker.last_name }}</span><br>
                                    <span class="font-medium text-gray-900 ">{{ speaker.job_title }}</span> at <span class="font-medium text-gray-900 ">{{ speaker.company }}</span>
                                </div>
                                <div class="text-sm font-normal">"{{ speaker.bio }}"</div>
                            </div>
                        </div>
                    </li>
                    
                </ol>
            </div>
            
            
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                event_sessions: [],
                sortDate: false,
                showSessions: false,
            }
        },
        created() {
            this.axios.get('http://localhost/api/get_event_sessions/')
            .then(response => {
                this.event_sessions = response.data;
                this.showSessions = true;
            });
        },

        computed: {
            newDates: function() {
                let order = this.sortDate ? 1 : -1;
                this.event_sessions.sort(function(a, b) {
                    a = new Date(a.date);
                    b = new Date(b.date);
                    let results = a > b ? -1 : a < b ? 1 : 0;
                    return results * order;
                });
            }
        },

        methods: {
            showDetails(id) {
                let el = document.getElementById(id);
                el.classList.toggle('hidden');
            },
            toggleSort() {
                this.sortDate = !this.sortDate;
            },
            getEventMonth(eventDate) {
                let date = new Date(eventDate);
                return new Intl.DateTimeFormat('default', {month: 'long'}).format(date);
            },
            getEventDay(eventDate) {
                let date = new Date(eventDate);
                return new Intl.DateTimeFormat('default', {day: 'numeric'}).format(date);
            },
            getEventWeekDay(eventDate) {
                let date = new Date(eventDate);
                return new Intl.DateTimeFormat('default', {weekday: 'long'}).format(date);
            },
        }
    }
</script>