@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 18rem;">
                <h5 class="text-center">{{$plan['name']}}</h5>

                <div class="card-body">
                    <p style="font-weight: normal;font-size: 16px">You wll be charged <span class="card-title"> ${{number_format($plan['price'])}}</span>

                    <form id="payment-form" action="{{url(route('plan.payment'))}}" method="POST">
                        @csrf
                        <input type="hidden" name="planid" id="planid" value="{{ $plan['id'] }}">

                        <div class="row ">
                            <div class="">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="card-holder-name" class="form-control" value=""
                                           placeholder="Name on the card">
                                </div>


                                <div class="">
                                    <div class="form-group">
                                        <label for="">Card details</label>
                                        <div id="card-element"></div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary" id="card-button"
                                            data-secret="{{ $intent->client_secret }}">Purchase
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('script')
    <style>


    </style>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}')

        const elements = stripe.elements();
        const cardElement = elements.create('card');
        console.log(cardElement);

        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form')
        const cardBtn = document.getElementById('card-button')
        const cardHolderName = document.getElementById('card-holder-name')

        form.addEventListener('submit', async (e) => {
            e.preventDefault()

            cardBtn.disabled = true
            const {setupIntent, error} = await stripe.confirmCardSetup(
                cardBtn.dataset.secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            )
        console.log(error);
            if (error) {
                cardBtn.disable = false
            } else {
                let token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit();
            }
        })
    </script>
@endsection
