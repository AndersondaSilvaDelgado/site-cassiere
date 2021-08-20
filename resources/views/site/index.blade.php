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
        <input class="form-control me-2" type="search" placeholder="Pesquisar Produtos..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
    </div>

    <div class="container">
        <div class="row row-cols-md-4">
            @foreach($produtos as $produto)
            <div class="col col-index">
                <a href="{{ route('site.produto', $produto->id) }}">
                    <div class="card">
                        <img src="{{ asset($produto->imagem) }}" class="img-responsive card-img-top" alt="{{ $produto->nome }}">
                        <div class="card-body">
                            <p>{{ $produto->nome }}</p>
                            <p>R$ {{ $produto->valor }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @if ($loop->iteration % 4 == 0)
        </div>
        <div class="row row-cols-md-4">
            @endif
            @endforeach
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Primeira</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>

@endsection
