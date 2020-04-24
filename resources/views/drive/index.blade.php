@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            @foreach($list as $key => $file)
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="shadow p-3 mb-4 bg-white"
                         data-toggle="modal" data-target="#first-modal"
                         onclick="open_modal({{$key}})">
                        <i class="far fa-folder"></i>
                        <a >{{$file->getName()}}</a>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
    @include('layouts.modals')
    <script>
        var list = <?php echo json_encode($list); ?>;

        let modal = {
            object: {},
            title: "",
            body: "",
            footer: "",
        }
        function open_modal(index) {
            console.log(list[index])
            var file_id = list[index].id
            var name = list[index].name

            clearModal('first-modal')
            modalSize('first-modal', 'lg')
            let array = []

            modal.title = name;
            modal.body = `
                <form action="/upload" method="post" enctype="multipart/form-data">
                        <input type="file" class="form-control" name="thing">
                        <input type="hidden" class="form-control" name="file_id" value="${file_id}">
                        <br>
                        @csrf
                    <input type="submit" class="btn btn-sm btn-block btn-danger"
                    value="Upload">
                </form>

            `
            // modal.footer = `<button class="btn btn-success" onclick="send_data()">Guardar</button>`
            $('#first-modal-title').html(modal.title)
            $('#first-modal-body').html(modal.body)
            $('#first-modal-footer').html('')
            // $('#first-modal').modal('hide')

            // console.log('id',id )
            // console.log('name',name )
        }

    </script>


@endsection
