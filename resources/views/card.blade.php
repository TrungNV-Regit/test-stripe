<!DOCTYPE html>
<html>

<head>
    <title>Card Info</title>
    <link rel="stylesheet" href="{{Vite::asset('resources\css\bootstrap.css')}}">
</head>

<body>

    <div class="container">
        <h1>Stripe Payment from your card</h1>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <h2 class="panel-title">Checkout Forms</h2>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif

                        <form id='checkout-form' method='post' action="{{ route('customer.store') }}">
                            @csrf
                            <input type='hidden' name='paymentMethodId' id='paymentMethodId'>
                            <br>
                            <div id="card-element" class="form-control"></div>
                            <button id='payment' class="btn btn-success mt-3" type="button" style="margin-top: 20px; width: 100%;padding: 7px;">PAY
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    const stripe = Stripe('{{env('STRIPE_KEY')}}')
    const button = document.getElementById('payment')
    const elements = stripe.elements()
    const cardElement = elements.create('card')
    // card, cardNumber, cardExpiry, cardCvc, postalCode, paymentRequestButton, iban, idealBank, p24Bank, auBankAccount, fpxBank, affirmMessage, afterpayClearpayMessage, paymentMethodMessaging
    cardElement.mount('#card-element')
    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    button.addEventListener('click', async function() {
        document.getElementById("payment").disabled = true

        // create token
        // const { token, error } = await stripe.createToken(cardElement)
        // console.log('token :>> ', token)
        // console.log('error :>> ', error)

        const {
            paymentMethod,
            error
        } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement
        })

        if (error) {
            document.getElementById("pay-btn").disabled = false
            alert(result.error.message)
        }

        if (paymentMethod) {
            document.getElementById("paymentMethodId").value = paymentMethod.id
            document.getElementById('checkout-form').submit()
        }
    })
</script>

</html>
