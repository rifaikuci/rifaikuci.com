

function formateTutar(tutar) {
    return tutar.toLocaleString("tr-TR", { style: "currency", currency: "TRY" });
}

var plusCalculate = new Vue({
    el: "#calculate-plus", data: {
        items : [{value : null, percent: null}],
        sum : 0,
        sumLabel : formateTutar(0),
    },



    methods: {
        handleAddItems(event) {

            this.items.push({value: null, percent: null});
            this.calculate();
        },

        calculate() {
            this.sum = 0;
            this.items.forEach(x=> {

                if(x.value && x.value > 0) {
                    this.sum = Number(this.sum) + Number(x.value)
                }
            });


            this.items.forEach(x=> {
                if(x.value && x.value > 0) {
                    x.percent = 100 * Number(x.value) / this.sum;
                    x.percent = Number(x.percent).toFixed(2);
                    x.value = formateTutar(x.value);
                }
            })

            this.sumLabel = formateTutar(this.sum);

        }
    }
});

