
@extends("layouts.admin")

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            @if (Session::has('admin-mensagem-sucesso'))
                <div class="alert alert-success" role="alert">
                    <strong>{{ Session::get('admin-mensagem-sucesso') }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Produtos</h3>
                    <div class="card-tools">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.produto.create'); }}">
                            <i class="far fa-file">
                            </i>
                            Create
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 10%">
                                    Id
                                </th>
                                <th style="width: 50%">
                                    Nome
                                </th>
                                <th style="width: 10%" class="text-center">
                                    Valor
                                </th>
                                <th style="width: 10%" class="text-center">
                                    Status
                                </th>
                                <th style="width: 20%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td>
                                        {{ $produto->id }}
                                    </td>
                                    <td>
                                        {{ $produto->nome }}
                                    </td>
                                    <td class="text-center">
                                        R$ {{ $produto->valor }}
                                    </td>
                                    @if ($produto->ativo === 'S')
                                        <td class="project-state">
                                            <span class="badge badge-success">Ativo</span>
                                        </td>
                                    @else
                                        <td class="project-state">
                                            <span class="badge bg-danger">Inativo</span>
                                        </td>
                                    @endif
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.produto.edit', $produto->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="#" onclick="excluirProduto({{ $produto->id }})">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                  </div>
                  <!-- /.card-footer -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <form id="form-excluir-produto" method="POST" action="{{ route('admin.produto.delete') }}">
        {{ csrf_field() }}
        <input type="hidden" name="id">
    </form>

@endsection
