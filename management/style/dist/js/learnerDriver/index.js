new Vue({
    el: "#payment-detail-show",
    data: {
        driverI: ''
    },


    methods: {
        paymentDetail(event) {
            console.log("asdasd")

            if (event.target.dataset.driverid) {
                debugger;
                $.ajax({
                    url: BASE_URL+'kusva/learnerDriver/paymentDetail.php',
                    type: 'post',
                    data: {
                        driverId: event.target.dataset.driverid,
                    },
                    success: function (response) {
                        $('.modal-body').html(response);
                        $('#modalviewpayment').modal('show');

                    },
                    error: function (response) {
                        console.log(response)
                    }
                });
            }
        }
    }

});