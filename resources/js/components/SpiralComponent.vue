<template>

    <div :class="{'loading': loading}">
        <a href="/generate/spiral"><button type="button" class="btn btn-outline-primary">Generate Random Spiral</button></a>

<div class="row pt-3">
    <div class="col-lg-4">
        <p class="instructions">* Click the button to generate random names to be a spiral text. <br>
            * It will loop random number of iterations from 5-10 that will generate a random 5-character alphanumeric string for the breakdown. 
        </p>
        <small>
        <p class="text-danger"><b class="mr-2">Remaining Spiral: </b> 
            {{ spirals_remaining }}
        </p>
        <p><b>Current Random Name: <span class="badge badge-pill badge-warning randomName">{{ current_spiral_name }}</span></b></p>
    </small>
                    
                </div>
            </div>


            <div class="row justify-content-center text-center py-5">
                <div class="col-lg-12">
                  <div id="container">     

        <svg preserveAspectRatio="xMidYMin slice" viewBox="0 0 728 380">
                      <!--Background-->  
                      <path d="M0 0h728v400H0z" fill="#fff"/> 
                      <!--Spiral path-->  
                      <defs>
                        <path id="s" d="M363.32 203.973c3.65 3.65-3.119 6.72-6.066 6.066-7.986-1.773-9.27-12.002-6.066-18.198 5.731-11.082 20.612-12.38 30.33-6.065 14.26 9.267 15.584 29.339 6.065 42.46-12.686 17.49-38.107 18.828-54.592 6.067-20.745-16.06-22.09-46.897-6.066-66.725 19.408-24.015 55.695-25.365 78.856-6.066 27.294 22.744 28.648 64.502 6.066 90.988-26.071 30.58-73.313 31.935-103.12 6.066-33.869-29.394-35.225-82.127-6.066-115.252 32.713-37.16 90.944-38.518 127.384-6.065 40.455 36.028 41.813 99.762 6.065 139.515-39.342 43.75-108.581 45.11-151.646 6.065-47.048-42.655-48.408-117.402-6.066-163.778 45.966-50.346 126.224-51.706 175.91-6.066 53.645 49.277 55.005 135.047 6.066 188.042-52.587 56.945-143.87 58.305-200.174 6.066-60.244-55.895-61.605-152.693-6.066-212.306 59.204-63.545 161.518-64.906 224.438-6.065 53.59 50.116 66.879 131.92 33.787 197.072" />
                      </defs>  
                      <!--Text & link to path-->  
                      <text font-family="monospace" font-size="15" fill="#1d1f20">
                      <textPath id="text" xlink:href="#s">{{ paragraph }}</textPath>
                      </text>  
                    </svg>
                    
                    <div class="col-lg-12 next-btn">
                      <div class="mb-3 mt-5">
                        <p>Generated Breakdown Names for <span class="badge badge-warning">{{ current_spiral_name }}</span> are:</p>
                          
                     
                            <span class="badge badge-primary mr-1" v-for="breakdown in breakdowns" v-bind:key="breakdown.random_id">{{ breakdown.values }}</span>
        
                        
                    </div>

                      <button type="button" class="btn btn-outline-danger" @click="loadSpiral()">Show More Spiral <i class="fas fa-chevron-right"></i></button>
                    </div>

    </div>
</div></div></div>
</template>

<script>
    export default {
        data: function() {
            return {
                spirals_remaining: '',
                current_spiral_name: '',
                breakdowns: [],
                paragraph: '',
            }
        },
        mounted() {
            this.loadSpiral();
            console.log('Spiral Component mounted.')
        },
        methods: {
            loadSpiral: function() {
                axios.get('api/get/spiral')
                    .then((response) => {
                        this.spirals_remaining = response.data.random_remaining;
                        this.current_spiral_name = response.data.spiral;
                        this.breakdowns = response.data.breakdowns;
                        this.paragraph = response.data.paragraph;

                        if(this.spirals_remaining == 0){
                            alert('No more Spirals left. Please generate random spiral again.')
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

        }

    }
</script>
