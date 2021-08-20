@extends("layouts.admin")

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <!-- Default box -->
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Editar Produto</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.produto.update', $produto->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @include('admin.produto._partials.form')
                    </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
