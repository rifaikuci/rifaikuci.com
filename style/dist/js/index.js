const {createApp} = Vue

var balyalamaGiris = createApp({
    data() {
        return {
            message: 'Hello Vue!',
        }
    },

    methods: {
        messageData(event) {
            console.log(event.target.value)
        }
    },

    mounted: function (event) {


    }
}).mount('#app')

$('#supplier_id').on("change", async function () {

});



