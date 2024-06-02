new Vue({
    el: "#payment-detail-show",
    data: {
        driverI: ''
    },


    methods: {
        paymentDetail(event) {
            console.log("asdasd")

            if (event.target.dataset.driverid) {
                $.ajax({
                    url: BASE_URL+'kusva/learnerDriverUser/paymentDetail.php',
                    type: 'post',
                    data: {
                        driverHistoryShow: event.target.dataset.driverid,
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