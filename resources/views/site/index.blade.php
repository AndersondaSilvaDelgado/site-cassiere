@extends("layouts.site")

@section('content')

    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('foto/foto1.jpg') }}" class="d-block w-100" alt="foto1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('foto/foto2.jpg') }}" class="d-block w-100" alt="foto2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('foto/foto3.jpg') }}" class="d-block w-100" alt="foto3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container mb-2 pr-5 pl-5">
        <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <a href="#">
                    <div class="card">
                        <img src="{{ asset('image/image1.jpg') }}" class="img-responsive card-img-top" alt="image1">
                        <div class="card-body">
                            <p>Bolsa</p>
                            <p>R$ 100,00</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#">
                    <div class="card">
                        <img src="{{ asset('image/image2.jpg') }}" class="img-responsive card-img-top" alt="image2">
                        <div class="card-body">
                            <a href="#">bolsa</a>
                            <p>R$ 100,00</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#">
                    <div class="card">
                        <img src="{{ asset('image/image3.jpg') }}" class="img-responsive card-img-top" alt="image3">
                        <div class="card-body">
                            <a href="#">bolsa</a>
                            <p>R$ 100,00</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#">
                    <div class="card">
                        <img src="{{ asset('image/image4.jpg') }}"  class="img-responsive card-img-top" alt="image1">
                        <div class="card-body">
                            <a href="#">bolsa</a>
                            <p>R$ 100,00</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="#">
                    <div class="card">
                        <img src="{{ asset('image/image1.jpg') }}" class="img-responsive card-img-top" alt="image1">
                        <div class="card-body">
                            <p>Bolsa</p>
                            <p>R$ 100,00</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#">
                    <div class="card">
                        <img src="{{ asset('image/image2.jpg') }}"  class="img-responsive card-img-top" alt="image1">
                        <div class="card-body">
                            <a href="#">bolsa</a>
                            <p>R$ 100,00</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#">
                    <div class="card">
                        <img src="{{ asset('image/image3.jpg') }}" class="img-responsive card-img-top" alt="image1">
                        <div class="card-body">
                            <a href="#">bolsa</a>
                            <p>R$ 100,00</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#">
                    <div class="card">
                        <img src="{{ asset('image/image4.jpg') }}"  class="img-responsive card-img-top" alt="image1">
                        <div class="card-body">
                            <a href="#">bolsa</a>
                            <p>R$ 100,00</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
