@extends('base.admin')

@section('content')
<section class="login-section" style="font-family: 'Montserrat', sans-serif; background-color: #f9fdf8; min-height: 50vh; display: flex; flex-direction: column; align-items: center; justify-content: center;">  

    <div class="container text-left" style="padding-top: 50px">
        <h1 class="display-4 fw-bold" style="color:black;">{{ strtoupper($category->nama) }}</h1>
        <a href="{{ route('addservices.show') }}" class="btn py-2 px-4" style="margin-top:5px; background-color: #FFC400; color: white; border-radius: 5px; font-size: 14px; font-weight: bold; text-decoration: none;">
            + Tambah Layanan
        </a>
    </div>
    

    <div class="container mx-5 my-5">
    <div class="row justify-content-center gy-4">
        @foreach($services as $service)
        <div class="col-lg-3 col-md-6 ms-0" style="width: 270px; ">
            <div class="card mx-auto d-flex flex-column justify-content-between" style="border:1px solid #2E8656; height: 350px;">
                <div style="
                    background-image: url('{{ asset('Images/' . $service->gambar . '.png') }}');
                    background-size: cover;
                    background-position: center;
                    height: 200px;">
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="mb-1" style="font-size: 16px; font-weight: bold; color:#014A3F;">
                            {{ $service->nama }}
                        </h5>
                        <p class="text-dark mb-3" style="font-size: 14px;">
                            Rp{{ number_format($service->harga, 0, ',', '.') }}/{{ $service->satuan }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between mt-auto">
                        <a href="#" 
                            onclick="alert('Layanan berhasil dihapus.')" 
                            class="btn py-2 px-4" 
                            style="background-color: #40744E; color: white; border-radius: 5px; font-size: 14px; font-weight: bold; text-decoration: none;">
                            Hapus
                            </a>
                        <a href="{{ route('editservices.show',$service->id) }}" class="btn py-2 px-4" style="background-color: red; color: white; border-radius: 5px; font-size: 14px; font-weight: bold; text-decoration: none;">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


</section>
@endsection
