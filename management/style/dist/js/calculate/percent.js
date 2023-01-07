

function formateTutar(tutar) {
    return tutar.toLocaleString("tr-TR", { style: "currency", currency: "TRY" });
}

var percentCalculate = new Vue({
    el: "#calculate-percent", data: {
        items : [{value : null, percent: null, valueLabel: null}],
        sum : null,
    },



    methods: {
        handleAddItems(event) {

            this.items.push({value: null, percent: null});
            this.calculate();
        },

        calculate() {

            let sumTemp = 0;
            this.items.forEach(x=> {
                if(x.percent && x.percent > 0) {
                    x.value = (this.sum / 100) * x.percent;
                    x.valueLabel =formateTutar(x.value);
                    sumTemp = Number(sumTemp) + Number(x.value);

                }
            })
            this.sumLabel = formateTutar(sumTemp);

        }
    }
});

