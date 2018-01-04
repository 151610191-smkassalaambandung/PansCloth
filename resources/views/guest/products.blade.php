<h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3"></span>
      <span class="site-heading-lower">Produk</span>
    </h1>

    

@extends('layouts.user')
@section('content')
@foreach ($Lainnya as $data) 
<body style="background:linear-gradient(rgba(47,23,15,.65),rgba(47,23,15,.65)),url(../img/img1/{{$data->cover}});
              background-repeat: no-repeat;
              background-size: cover; 
              background-attachment: fixed;">
    <section class="page-section cta">
      <div class="container">
          <div class="col-xl-9 mx-auto">
            <div class="cta-inner text-center rounded">


              <p class="mb-0">
                
                  <b>Untuk Pemesanan Hubungi:</b>
                <br>
                <br>
                WhatsApp/SMS/Telp : (022) 585-8468
                <br>
                Line : @panscompany (Jangan Lupa Gunakan @)   
                <br>
                E-mail : panscompany.gmail.com
              </p>
              <br>
              <br>

              <b>Atau Datang Ke Offline Store Kami Di</b>
              <br>
              
              <p class="address mb-5">
                <em>
                  <strong>Jalan Kenangan No.24
                  <br>
                  Bandung, Indonesia</strong>
                </em>
              </p>
</div>
</div>
</div>
</section>


         @foreach ($Product as $data)
 
    <section class="page-section">
      <div class="container">
        <div class="product-item">
          <div class="product-item-title d-flex">
            <div class="bg-faded p-5 d-flex ml-auto rounded">
              <h2 class="section-heading mb-0">
                <span class="section-heading-lower"><i>{!!$data->nama_product!!}</i></span>
              </h2>
            </div>
          </div>
          <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="/img/img7/{{$data->cover}}" width="900px" height="1000px">
          <div class="product-item-description d-flex mr-auto">
            <div class="bg-faded p-5 rounded">

              <p class="mb-0"><center><h2><b><u>Detail</u></b></h2></center>  <br>{!!$data->detail!!}</p>
            </div>
          </div>
        </div>
      </div>
    </section>


      @endforeach
@endforeach

@endsection