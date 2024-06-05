new Vue({
    el: "#group-detail-show",
    data: {
        driverI: ''
    },


    methods: {
        groupDetail(event) {
            if (event.target.dataset.groupid) {
                $.ajax({
                    url: BASE_URL+'kusva/learnerDriverGroup/detail.php',
                    type: 'post',
                    data: {
                        groupDetailShow: event.target.dataset.groupid,
                    },
                    success: function (response) {
                        $('.modal-body').html(response);
                        $('#modalviewgroup').modal('show');

                    },
                    error: function (response) {
                        console.log(response)
                    }
                });
            }
        }
    }

});