var app = new Vue({
	el: '#root',
	data: {
		location: '',
	},
	methods: {
		checkWeather(){
			let app = this
                axios.post('weather')
                    .then(function(response) {
                        app.brands = response.data
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
			console.log("Niaz");
		}
	}
})