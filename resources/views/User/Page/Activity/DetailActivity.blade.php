@extends('User.Master')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Activity</h2>
          <ol>
            <li><a href="">Marketplace</a></li>
            <li>Detail Pesanan</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="about p-3">
        <div class="container" data-aos="fade-up">
                        <?php
                            $no = 0;
                        ?>
                        @if($trans->isEmpty())
                            <center><h5>Maaf... Belum Ada Pesanan...</h5></center>
                        @else
                        @foreach($trans as $or)
                        <div class="icon-box iconbox-blue p-4 mt-4" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                            <div class="row mb-4">
                                <div class="col-md-8">
                                    <h4 ><a href="" style="font-size: 22px;">Nomor Order : {{$or->no_order}}</a></h4>
                                </div>
                                <div class="col-md-4 float-end">
                                    <h4 class="float-end">Pembayaran : {{$or->pembayaran}}</h4><br>
                                    @if($or->pembayaran == '3 bulan' || $or->pembayaran == '6 bulan' || $or->pembayaran == '12 bulan')
                                    <span class="float-end" style="color: red;">*Pembayaran Setiap Tanggal 25</span>
                                    @else
                                    @endif
                                </div>
                            </div>      
                                                    @if($or->pembayaran == '3 bulan')
                                                        @for($i = 1; $i <= 3; $i++)
                                                            <p>Pembayaran Cicilan Ke-{{$i}} :  <b>@currency($or->total /3)</b></p>
                                                        @endfor
                                                    @elseif($or->pembayaran == '6 bulan')
                                                        @for($i = 1; $i <= 6; $i++)
                                                            <p>Pembayaran Cicilan Ke-{{$i}} :  <b>@currency($or->total /6)</b></p>
                                                        @endfor
                                                    @elseif($or->pembayaran == '12 bulan')
                                                        @for($i = 1; $i <= 12; $i++)
                                                            <p>Pembayaran Cicilan Ke-{{$i}} :  <b>@currency($or->total /12)</b></p>
                                                        @endfor
                                                    @else
                                                        <p class="text-center">PEMBAYARAN SECARA TUNAI</p>
                                                    @endif
                                        <hr>
                                                    
                                        <div class="row mb-4">
                                            <div class="col-md-8">
                                                <h4 ><a href="" style="font-size: 22px;">Status Pesanan : {{$or->status}}</a></h4>
                                            </div>
                                            <div class="col-md-4 float-end">
                                                <h4 class="text-end"><a href="" style="font-size: 22px;">Total Pesanan : @currency($or->total)</a></h4>
                                            </iv>
                                        </div>
                        </div>
                        @endforeach
                        @endif
        </div>
    </section>
@endsection