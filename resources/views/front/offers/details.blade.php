@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <!--Grid column-->
            @if($offer)
                <div class="col-md-4 mb-4">

                    <div class="card">
                        <div class="card-body text-center">

                            <h5 class="mt-0 mb-1 mb-2">{{$offer -> title}}
                            </h5>
                            <p class="grey-text mb-2" >{{$offer -> description}}</p>
                            <p class="grey-text mb-2" id="price">{{$offer -> price}}</p>


                            <img
                                src="https://www.91-img.com/pictures/133432-v4-xiaomi-mi-a3-mobile-phone-large-1.jpg?tr=q-60"
                                class="my-3" alt="Angular logo">

                            <br>

                            <a id="checkout" href="{{route('offers.checkout',$offer -> price)}}"
                               role="button" class="btn  btn-success px-3 waves-effect waves-light"> شراء المنتج
                            </a>
                        </div>

                    </div>

                </div>
                <div class="col-md-4 mb-4">
                    <h3>اختر وسيله الدفع المناسبه</h3>

                    <div id="showPayForm"></div>

                    @if(isset($success))
                           <div class="alert alert-success text-center">
                                  تم الدفع بنجاح
                           </div>
                        @endif


                    @if(isset($fail))
                        <div class="alert alert-danger text-center">
                            فشلت عملية الدفع
                        </div>
                    @endif

                </div>

        @endif
        <!--Grid column-->

            <div class="col-md-6">


            </div>

        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).on('click', '#checkout', function (e) {
              e.preventDefault();
             $.ajax({
                type: 'get',
                url: "{{route('offers.checkout')}}",
                data: {
                    price: $('#price').text(),
                    offer_id: '{{$offer -> id}}',
                },
                success: function (data) {
                    if (data.status == true) {

                        $('#showPayForm').empty().html(data.content);

                    } else {
                     }
                }, error: function (reject) {
                }
            });
        });
    </script>
@stop
