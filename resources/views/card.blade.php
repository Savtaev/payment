<div class="container-fluid paycard">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card mx-auto">
                <p class="heading">PAYMENT DETAILS</p>
                    <div class="form-group mb-0">
                        <p class="text-warning mb-0">Номер карты</p>
                        <input type="text" name="pan" placeholder="1234 5678 9012 3457" id="cno">
                    </div>

                    <div class="form-group">
                        <p class="text-warning mb-0">Имя на карте</p> <input type="text" pattern="^[a-zA-Z]{1,15} [a-zA-Z]{1,15}$" name="card_holder" placeholder="Name">
                    </div>
                    <div class="form-group pt-2">
                        <div class="row d-flex">
                            <div class="col-sm-4">
                                <p class="text-warning mb-0">Срок</p>
                                <input type="text" name="exp_year_month" pattern="^\d{2}\/\d{2}$" placeholder="MM/YY" size="5" id="exp" minlength="5" maxlength="5">
                            </div>
                            <div class="col-sm-3">
                                <p class="text-warning mb-0">Cvv</p>
                                <input type="password" name="cvc" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<style>


    .text-warning{
        font-size: 12px;
        font-weight: 500;
    }
    #cno{
        transform: translateY(-10px);
    }
    .paycard input{
        border-bottom: 1.5px solid #E8E5D2!important;
        font-weight: bold;
        border-radius: 0;
        border: 0;

    }
    .paycard .form-group input:focus{
        border: 0;
        outline: 0;
    }
    .paycard .col-sm-5{
        padding-left: 90px;
    }
    .paycard .btn:focus{
        box-shadow: none;
    }
    .paycard .col-sm-12{
        padding-left: 0;
    }
</style>