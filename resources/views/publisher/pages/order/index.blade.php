@extends('publisher.dashboard')
@section('title', __('Order Details'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Order Details') }}</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xxl-10">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('Product Title') }}</th>
                                                    <th>{{ __('Package') }}</th>
                                                    <th>{{ __('Duration Date') }}</th>
                                                    <th>{{ __('Start Date') }}</th>
                                                    <th>{{ __('End Date') }}</th>
                                                    <th class="text-end">{{ __('Price') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="">1</td>
                                                    <td>
                                                        {{ $date_package_product->product->trans->where('locale', $current_lang)->first()->title }}
                                                    </td>
                                                    <td>{{ $date_package_product->package->trans->where('locale', $current_lang)->first()->title }}
                                                    </td>
                                                    <td>{{ $date_package_product->date->duration }} </td>
                                                    <td>{{ $date_package_product->start_date }}</td>
                                                    <td>{{ $date_package_product->end_date }}</td>
                                                    <td>{{ $date_package_product->date->price }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <form action="{{route('publisher.orders.store')}}" method="POST">
                                    @csrf
                                    <input type="text" name="date_package_id" id="date" class="form-control" value="{{ $date_package_product->id }}" hidden>
                                    <input type="text" name="package_id" id="package" class="form-control" value="{{ $date_package_product->package_id }}" hidden>
                                    <input type="text" name="product_id" id="product" class="form-control" value="{{ $date_package_product->product_id }}" hidden>
                                    <input type="text" name="price" id="product" class="form-control" value="{{ $date_package_product->date->price }}" hidden>
                                    <div class="payment-wrapper d-flex">
                                        <div class="mobile-wallet-wrapper w-50">
                                            <div class="mobile-wallet">
                                                <input type="radio" name="payment_method" id="pay-method-one" value="payment_mobile_wallet" />
                                                <label for="pay-method-one">
                                                    <img width="40" src="{{asset('assets/admin/images/default/payment_image/icons8-wallet-64.png')}}" alt="" >
                                                    <span>Mobile wallet</span>
                                                </label>
                                            
                                            </div>
                                            <div class="mobile-wallet-input d-none">
                                                <input type="text" placeholder="phone number"  class="form-control" name="mobile"/>
                                            </div>
                                        </div>
                                        <div class="bank-card w-50">
                                            <input type="radio" name="payment_method" checked id="pay-method-two" value="paymob_card_payment"/>
                                            <label for="pay-method-two">
                                                <img width="40" src="{{asset('assets/admin/images/default/payment_image/icons8-bank-card-64.png')}}" alt="">
                                                <span>Card</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary waves-effect waves-light"
                                            type="submit">{{ __('Payment') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </div>
        </div> <!-- end col-->
    </div>
@endsection
@section('script')
<script>
    const mobileWallet = document.querySelector('.mobile-wallet');
    const mobileWalletInput = document.querySelector('.mobile-wallet-input');
    const bankCard = document.querySelector('.bank-card');

    bankCard.addEventListener("click",function(){
       if( mobileWalletInput.classList.contains('d-block')){
           mobileWalletInput.classList.remove('d-block');
           mobileWalletInput.classList.add('d-none');
       }
    })

    mobileWallet.addEventListener('click',function(){
        if(mobileWalletInput.classList.contains("d-none") && !mobileWalletInput.classList.contains("d-block") ){
            mobileWalletInput.classList.remove('d-none');
            mobileWalletInput.classList.add('d-block');
        }
        
    })
</script>
@endsection
