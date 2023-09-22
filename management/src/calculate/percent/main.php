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
                        <label> Toplam </label>

                        <input class="form-control"
                               v-model="sum"
                               type="number">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                    <label> --- </label>

                    <button style="margin-left: 12px" type="submit"
                            v-on:click="calculateForSum"
                            class="btn btn-outline-success float-right">
                        Hesapla
                    </button>
                    </div>
                </div>
            </div>


            <div class="row" v-for="(item,index) in items">

                <div class="col-sm-2">
                    <div class="form-group">
                        <label> Kişi İsmi </label>
                        <input class="form-control"
                               v-model="item.name"
                               type="text">
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="form-group">
                        <label> {{index+1}}. Tutar </label>

                        <input class="form-control"
                               v-model="item.value"
                        >

                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label> {{index+1}}. Değer (%) </label>
                        <input class="form-control"
                               max="100"
                               min="0"
                               disabled
                               v-model="item.percent"
                               type="number">
                    </div>
                </div>


                <div class="col-sm-1">

                    <label> ---</label>

                    <div class="form-group">
                        <button class="btn btn-outline-danger" v-on:click="percentDelete(index)">X</button>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label> Ekle Çıkar </label>

                        <input class="form-control"
                               type="number"
                               v-model="item.tempValue"
                        >
                    </div>
                </div>

                <div class="col-sm-1">
                    <div class="form-group">
                        <label> --- </label>

                        <div>
                            <button class="btn btn-outline-primary" v-on:click="processAmount(index)">Ekle-Çıkar
                            </button>

                        </div>

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
                        Kayıt Ekle
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

        <div class="card-footer">
            <div>
                <button v-on:click="submit" class="btn btn-dark float-right">Kaydet</button>

            </div>
        </div>

    </div>


</section>


