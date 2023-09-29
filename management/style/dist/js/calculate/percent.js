

function formateTutar(tutar) {
    return tutar.toLocaleString("tr-TR", { style: "currency", currency: "TRY" });
}

var percentCalculate = new Vue({
    el: "#calculate-percent",
    data: {
        items : [{value : null, percent: null, valueLabel: null, name: null, temoValue: ''}],
        sum : null,
    },


    mounted: async function () {

        degerler = await axios.post(BASE_URL+'/kusva/index.php', {
            action: 'stockCalculate',
        }).then((response) => {
            return response.data
        });

        if(degerler.stockAmount) {
            this.items = []
            this.sum = degerler.stockAmount
            let arrayStockPercent = degerler.stockPercent.split(";");
            let arrayStockPerson = degerler.stockPerson.split(";");
            let arrayStockItemAmount = degerler.stockItemAmount.split(";");

            for (let i = 0 ; i< arrayStockPercent.length ; i++ ) {
                this.items.push({
                    percent :  arrayStockPercent[i],
                    name :  arrayStockPerson[i],
                    value :  arrayStockItemAmount[i],
                })

            }
                this.calculate();

        }

    },


    methods: {
        handleAddItems(event) {

            this.items.push({value: null, percent: null, name: '', tempValue: ''});
            this.calculate();
        },

        calculate() {

            let sumTemp = 0;
            this.sum = 0;
             this.items.forEach(x=> this.sum = Number(this.sum)  +Number(x.value)  );
            this.items.forEach(x=> {
                if(x.value && x.value > 0 && this.sum >0 ) {

                    x.percent = (100 * x.value) / this.sum
                    x.percent = x.percent.toFixed(4);
                    x.valueLabel =x.value;
                    sumTemp = Number(sumTemp) + Number(x.value);
                }
            })
            this.sumLabel = sumTemp ?  formateTutar(sumTemp) :   formateTutar(0);
        },

        percentDelete (index) {
            this.$delete(this.items, index);
            this.calculate();
        },

        async submit(event) {
            event.preventDefault();
            let stockAmount = 0;
            let stockPerson = '';
            let stockPercent = '';
            let stockItemAmount = '';

            this.items.forEach(x=> {
                if(x.percent && x.percent > 0 && x.name) {
                    stockPercent = stockPercent + x.percent + ";";
                    stockPerson = stockPerson + x.name + ";";
                    stockItemAmount = stockItemAmount + x.value + ";";
                    stockAmount = Number(stockAmount) + Number(x.value);
                }
            })
            stockPercent = stockPercent.slice(0, -1);
            stockPerson = stockPerson.slice(0, -1);
            stockItemAmount = stockItemAmount.slice(0, -1);




            degerler = await axios.post(BASE_URL+'/kusva/index.php', {
                action: 'stockCalculateSubmit',
                stockAmount: stockAmount,
                stockPerson: stockPerson,
                stockPercent: stockPercent,
                stockItemAmount: stockItemAmount
            }).then((response) => {
                return response.data
            });

        },

        processAmount (i) {
            this.items.find((x,index) => index === i).value =
                Number(this.items.find((x,index) => index === i).value) + Number(this.items.find((x,index) => index === i).tempValue)
            this.items.find((x,index) => index === i).value =  (this.items.find((x,index) => index === i).value).toFixed(3)
            this.items.find((x,index) => index === i).tempValue= ''
            this.calculate();
        },

        calculateForSum() {
            let sumTemp = 0;

            this.items.forEach(x=> {
                if(x.percent && x.percent > 0) {
                    x.value = ((this.sum / 100) * x.percent).toFixed(3);
                    sumTemp = Number(sumTemp) + Number(x.value);

                }
            })

            this.sumLabel = sumTemp ?  formateTutar(sumTemp) :   formateTutar(0);

        }
    }
});

