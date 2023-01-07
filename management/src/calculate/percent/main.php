<section class="content">


    <div class="card-body" id="calculate-percent">


        <div class="row">
            <div class="col-sm-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h2 class="card-title">Yüzdeye Göre Hesapla</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="row">



                <div class="col-sm-2">
                    <div class="form-group">
                        <label> Toplam  </label>

                        <input class="form-control"
                               :value="sum"
                               v-model="sum"
                               type="number">
                    </div>
                </div>
            </div>


            <div class="row" v-for="(item,index) in items">


                <div class="col-sm-2">
                    <div class="form-group">
                        <label> {{index+1}}. Değer (%) </label>
                        <input class="form-control"
                               max="100"
                               min="0"
                               v-model="item.percent"
                               :value="item.percent"
                               type="number">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label> {{index+1}}. Tutar </label>

                        <input class="form-control"
                               disabled
                               v-model="item.valueLabel"
                               :value="item.valueLabel">
                    </div>
                </div>


            </div>

            <div class="row-reverse">
                <div class="col-sm-6">

                    <button style="margin-left: 12px" type="submit"
                            v-on:click="calculate"
                            class="btn btn-outline-success float-right">
                        Hesapla
                    </button>

                    <button type="submit"
                            v-on:click="handleAddItems"
                            class="btn btn-primary float-right">
                        Kayıt  Ekle
                    </button>


                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <h3 style="color: #0c84ff">Toplam : {{sumLabel}} </h3>

                </div>
            </div>
        </div>
    </div>
</section>


