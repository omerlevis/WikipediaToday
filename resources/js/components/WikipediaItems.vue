<script>
//make the api request to the controller and display the data in a resposvie cards.
//define buttons to make request with the next and the previous day.
//get the dark mode global vy @vuex-useStore parameter and effect the layout

import axios from 'axios';
import Navigation from "@/components/Navigation.vue";
import {useStore} from "vuex";
import {computed} from "vue";

import Body from "@/components/layouts/Body.vue";
import Dashboard from "@/components/layouts/Dashboard.vue";
import DashboardCover from "@/components/layouts/DashboardCover.vue";
import DashboardContent from "@/components/layouts/DashboardContent.vue";
export default {
    components: {
        Body,
        Navigation,
        Dashboard,
        DashboardCover,
        DashboardContent,
    },
    setup() {
        const store = useStore();
        const darkMode = computed(() => store.state.darkMode);
        return { darkMode };
    },
    data() {
        return {
            wikipedia_item: {},
            title_date:'',
            day:"",
            month:"",
            next_and_previous_dates: {},
            api_error: "",
            loading: false
        }
    },
    async created() {

            this.getData(this.$route.params.month, this.$route.params.day);
    },

    methods: {
        async getData($apiDay,$apiMonth){
            try {
                this.loading=true;
                const response = await axios.get(`/wikipedia/${$apiDay}/${$apiMonth}`)
                console.log(response.data);
                this.wikipedia_item = response.data['items'];
                this.day = response.data['day'];
                this.month = response.data['month'];
                this.next_and_previous_dates = response.data['next_previous_date'];
                this.title_date = "Wikipedia On this day for :\n " + this.month + "/" + this.day;
                this.api_error="";
            }
            catch (error){
                this.api_error="An error occurred while fetching data from the API. Please check your parameters";
                console.log(error);
            }
            this.loading=false;
        },

        async nextDay() {
            this.getData(this.next_and_previous_dates['next_month'],this.next_and_previous_dates['next_day']);
        },

        async previousDay() {
            this.getData(this.next_and_previous_dates['previous_month'],this.next_and_previous_dates['previous_day']);
        }
    }
}

</script>

<template>
    <Body>
            <Navigation/>
            <div v-if="loading" class="text-center"><h1> Get Data from Wikipedia API... </h1> </div>
            <div v-else>
            <Dashboard>
                <div v-if="api_error" class="text-danger">{{ api_error }}</div>
                <div v-else>
                <DashboardCover>
                                        <h1 style="color: darkorange;"> {{ title_date }} </h1>
                                        <div class="d-flex justify-content-center">
                                            <button className="btn btn-secondary text-white flex-grow-1 mx-2" @click="previousDay"> <h4>Previous Day</h4> </button>
                                                <button className="btn btn-secondary text-white flex-grow-1 mx-2" @click="nextDay"> <h4>Next Day</h4></button>
                                        </div>
                </DashboardCover>
                <DashboardContent>
                                    <div class="row g-4">
                                        <div v-for="item in wikipedia_item" :key="item.year" class="col-lg-3 col-md-3 col-12">
                                            <a :href="item.link" target="_blank" class="card-link">
                                            <div  :class="['card','h-100',{'dark-mode-card' : darkMode}] ">
                                                <div class="card-header text-center card-header-style">
                                                    <h5>{{ item.year }} </h5>
                                                </div>
                                                    <img :src="item.thumbnail" alt="Thumbnail" class="card-img-top img-fit">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ item.title }} </h5>
                                                    <p class="card-text">{{ item.text }}</p>
                                                    <div class="text-end">
                                                        <a :href =item.link target="_blank" class="btn btn-outline-primary">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                </DashboardContent>
                </div>
                </Dashboard>
            </div>
    </Body>

</template>

<style>

.card .img-fit{
    aspect-ratio: 16 / 9;
    object-fit: cover;
}
.card-body {
    display: flex;
    height:100%;
    flex-direction: column;
}
.card-text {
    flex-grow: 1;
}
.card-link {
    display: block;
    height: 100%;
    text-decoration: none;
    transition: transform 0.2s;
}
.card-link:hover {
    transform: scale(1.05);
}
.card-header-style{
    background-color: darkorange;
    color: white;
    font-weight: bold;
}
.dark-mode-card {
    background-color: #53535c;
    color: white;
}

@media (max-width: 767.98px) {
    .card .img-fit {
       aspect-ratio: 1.45 / 1;
    }
}

</style>
